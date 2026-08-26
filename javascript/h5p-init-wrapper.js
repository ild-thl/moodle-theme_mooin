/** @namespace */
var H5P = window.H5P = window.H5P || {};

// Store the original H5P.init
var originalH5PInit = H5P.init;

// Override with custom version that has the working srcdoc fallback
H5P.init = function (target) {
  // Call the original init first for everything else
  originalH5PInit.call(this, target);
  
  // Then re-process iframes with the corrected writeDocument
  H5P.jQuery('iframe.h5p-iframe:not(.mooin-h5p-jquery-override)', target).each(function () {
    const iframe = this;
    const $iframe = H5P.jQuery(iframe);
    
    const contentId = $iframe.data('content-id');
    const contentData = H5PIntegration.contents['cid-' + contentId];
    const contentLanguage = contentData && contentData.metadata && contentData.metadata.defaultLanguage
      ? contentData.metadata.defaultLanguage : 'en';

    const writeDocument = function () {
      const dochtml = '<!doctype html><html class="h5p-iframe" lang="' + contentLanguage + '"><head>' + H5P.getHeadTags(contentId) + '</head><body><div class="h5p-content" data-content-id="' + contentId + '"/></body></html>';
      // Use srcdoc for modern browsers (Safari 5.1+, all others)
      // This avoids XSS warnings and doesn't require a static file
      if ('srcdoc' in iframe) {
        iframe.srcdoc = dochtml;
      } else {
        // Fallback for older browsers
        iframe.contentDocument.open();
        iframe.contentDocument.write(dochtml);
        iframe.contentDocument.close();
      }
    };
    
    $iframe.addClass('h5p-initialized');
    $iframe.addClass('mooin-h5p-jquery-override');
    
    if (iframe.contentDocument !== null) {
      writeDocument();
    } else {
      $iframe.on('load', writeDocument);
    }
  });
};