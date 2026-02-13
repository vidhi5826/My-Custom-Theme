jQuery(document).ready(function($) {
    $('.mobile-menu-toggle').on('click', function() {
        $(this).toggleClass('active');
        $('.main-navigation').toggleClass('active');
        
        // Animate hamburger icon
        if ($(this).hasClass('active')) {
            $(this).find('span:nth-child(1)').css('transform', 'rotate(45deg) translate(5px, 5px)');
            $(this).find('span:nth-child(2)').css('opacity', '0');
            $(this).find('span:nth-child(3)').css('transform', 'rotate(-45deg) translate(7px, -6px)');
        } else {
            $(this).find('span').css({'transform': 'none', 'opacity': '1'});
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {

    const lightbox = document.querySelector(".custom-video-lightbox");
    const video = lightbox.querySelector("video");
    const closeBtn = lightbox.querySelector(".video-close");

    document.addEventListener("click", function (e) {
        const trigger = e.target.closest(".video-lightbox-trigger");
        if (!trigger) return;

        const videoSrc = trigger.getAttribute("data-video");
        if (!videoSrc) return;

        video.innerHTML = `<source src="${videoSrc}" type="video/mp4">`;
        video.load();

        lightbox.style.display = "flex";
        document.body.classList.add("video-lightbox-open");

        video.play().catch(() => {});
    });

    function closeVideo() {
        video.pause();
        video.currentTime = 0;
        video.innerHTML = "";
        lightbox.style.display = "none";
        document.body.classList.remove("video-lightbox-open");
    }

    closeBtn.addEventListener("click", closeVideo);

    lightbox.addEventListener("click", function (e) {
        if (e.target === lightbox) closeVideo();
    });

});


