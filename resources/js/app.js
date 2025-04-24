import './bootstrap';

$(document).ready(function () {

    let lastScrollTop = 0;
    let sidebarVisible = false;

    let sidebar = $('#sidebar');
    let mainContent = $('#mainContent');
    let toggleButton = $('#toggleSidebar');
    let toggleIcon = $('#toggleIcon');

    // Restore sidebar state from sessionStorage
    if (sessionStorage.getItem('sidebarVisible') === 'true') {
        sidebar.addClass('visible');
        mainContent.addClass('shift');
        toggleButton.css({ left: '210px', top: '70px' });
        toggleIcon.html('&lt;');
    }

    $('#toggleSidebar').on('click', function () {
        sidebar.toggleClass('visible');
        mainContent.toggleClass('shift');

        let isVisible = sidebar.hasClass('visible');
        sessionStorage.setItem('sidebarVisible', isVisible);

        // Adjust button position
        if (isVisible) {
            toggleButton.css({ left: '210px', top: '70px' });
            toggleIcon.html('&lt;');
        } else {
            toggleButton.css({ left: '10px', top: '70px' });
            toggleIcon.html('&gt;');
        }
    });

    $(window).on('scroll', function () {
        let st = $(this).scrollTop();
        let sidebar = $('#sidebar');
        let mainContent = $('#mainContent');
        let toggleButton = $('#toggleSidebar');

        if (st > lastScrollTop) {
            // Scrolling down, hide sidebar if it was open
            if (sidebarVisible) {
                sidebar.removeClass('visible');
                mainContent.removeClass('shift');
                toggleButton.css('left', '10px'); // Move back when hidden
            }
        } else {
            // Scrolling up, show sidebar if it was previously opened by button
            if (sidebarVisible) {
                sidebar.addClass('visible');
                mainContent.addClass('shift');
                toggleButton.css('left', '220px'); // Keep inside sidebar
            }
        }
        lastScrollTop = st <= 0 ? 0 : st;
    });

});
