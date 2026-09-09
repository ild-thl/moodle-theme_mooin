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

            const post = img.closest('.post-content-container, .post-message');
            const images = post ? Array.from(post.querySelectorAll('img')) : [img];
            openLightbox(images, images.indexOf(img));
        });
    });
});

const openLightbox = (images, startIndex) => {
    let currentIndex = startIndex >= 0 ? startIndex : 0;

    const updateImage = () => {
        const currentImage = images[currentIndex];
        image.src = currentImage.currentSrc || currentImage.src;
        image.alt = currentImage.alt || '';
        previous.hidden = images.length < 2;
        next.hidden = images.length < 2;
    };

    const showPrevious = () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    };

    const showNext = () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    };

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
    image.style.maxWidth = 'calc(100vw - 8rem)';
    image.style.maxHeight = 'calc(100vh - 4rem)';
    image.style.width = 'auto';
    image.style.height = 'auto';
    image.style.objectFit = 'contain';

    const previous = document.createElement('button');
    previous.className = 'mooin4-image-lightbox-previous';
    previous.type = 'button';
    previous.innerHTML = '&#10094;';
    previous.setAttribute('aria-label', 'Vorheriges Bild');

    const next = document.createElement('button');
    next.className = 'mooin4-image-lightbox-next';
    next.type = 'button';
    next.innerHTML = '&#10095;';
    next.setAttribute('aria-label', 'Nächstes Bild');

    const close = document.createElement('button');
    close.className = 'mooin4-image-lightbox-close';
    close.type = 'button';
    close.innerHTML = '&times;';
    close.setAttribute('aria-label', 'Bild schließen');

    overlay.appendChild(image);
    overlay.appendChild(previous);
    overlay.appendChild(next);
    overlay.appendChild(close);
    document.body.appendChild(overlay);

    const closeLightbox = () => {
        overlay.remove();
        document.removeEventListener('keydown', keyHandler);
    };

    const keyHandler = (event) => {
        if (event.key === 'Escape') {
            closeLightbox();
        } else if (event.key === 'ArrowLeft' && images.length > 1) {
            showPrevious();
        } else if (event.key === 'ArrowRight' && images.length > 1) {
            showNext();
        }
    };

    previous.addEventListener('click', showPrevious);
    next.addEventListener('click', showNext);
    close.addEventListener('click', closeLightbox);

    overlay.addEventListener('click', (event) => {
        if (event.target === overlay) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', keyHandler);
    updateImage();
};