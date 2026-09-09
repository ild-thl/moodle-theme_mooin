document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll(
        '.path-mod-forum .post-content-container img, ' +
        '.path-mod-forum .post-message img'
    ).forEach((img) => {
        // Prevent duplicate handlers if Moodle updates the post content.
        if (img.dataset.mooin4Lightbox === 'true') {
            return;
        }

        img.dataset.mooin4Lightbox = 'true';
        img.style.cursor = 'zoom-in';

        img.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            openLightbox(img);
        });
    });
});

    const openLightbox = (img) => {
        const overlay = document.createElement('div');
        overlay.className = 'mooin4-image-lightbox';
        overlay.setAttribute('role', 'dialog');
        overlay.setAttribute('aria-modal', 'true');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100vw';
        overlay.style.height = '100vh';
        overlay.style.zIndex = '99999';
        overlay.style.display = 'flex';
        overlay.style.alignItems = 'center';
        overlay.style.justifyContent = 'center';
        overlay.style.padding = '2rem';
        overlay.style.boxSizing = 'border-box';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';

        const image = document.createElement('img');
        image.src = img.src;
        image.alt = img.alt || '';
        image.style.maxWidth = 'calc(100vw - 4rem)';
        image.style.maxHeight = 'calc(100vh - 4rem)';
        image.style.width = 'auto';
        image.style.height = 'auto';
        image.style.objectFit = 'contain';

        const close = document.createElement('button');
        close.className = 'mooin4-image-lightbox-close';
        close.type = 'button';
        close.innerHTML = '&times;';
        close.setAttribute('aria-label', 'Bild schließen');
        close.style.position = 'absolute';
        close.style.top = '1rem';
        close.style.right = '1.5rem';
        close.style.border = '0';
        close.style.background = 'transparent';
        close.style.color = 'white';
        close.style.fontSize = '3rem';
        close.style.lineHeight = '1';
        close.style.cursor = 'pointer';

        overlay.appendChild(image);
        overlay.appendChild(close);
        document.body.appendChild(overlay);

        const closeLightbox = () => {
            overlay.remove();
            document.removeEventListener('keydown', escapeHandler);
        };

        const escapeHandler = (event) => {
            if (event.key === 'Escape') {
                closeLightbox();
            }
        };

        close.addEventListener('click', closeLightbox);

        overlay.addEventListener('click', (event) => {
            if (event.target === overlay) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', escapeHandler);
    };