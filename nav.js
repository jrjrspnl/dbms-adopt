document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop(); // Get current page from URL
    const navLinks = document.querySelectorAll('.nav-link'); // Get all navigation links
  
    // Update navigation links with active class based on current page
    const updateNavigation = () => {
      navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === currentPage || (currentPage === "" && linkPath === "index.html")) {
          link.classList.add('active'); // Add active class to the current link
        } else {
          link.classList.remove('active'); // Remove active class from other links
        }
      });
    };
  
    // Call updateNavigation initially
    updateNavigation();
  
    // Check if the contact link exists before adding event listener
    const contactLink = document.querySelector('.nav-link[href="#footer"]');
    if (contactLink) {
      contactLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        const footer = document.querySelector('footer');
        if (footer) {
          footer.scrollIntoView({ behavior: 'smooth' }); // Scroll smoothly to the footer
        }
  
        // Update active class for navigation links
        navLinks.forEach(link => {
          link.classList.remove('active'); // Remove active class from all links
        });
        contactLink.classList.add('active'); // Add active class to "Contact us" link
      });
    }
  
    // Example: Handle navigation button click event with debounce
    const navigateButton = document.getElementById("navigateButton");
    if (navigateButton) {
      navigateButton.addEventListener('click', () => {
        debounce(() => {
          // Example navigation logic
          // window.location.href = 'desired_page.html';
          // Call updateNavigation after navigating if necessary
          updateNavigation();
        }, 1000); // 1-second delay
      });
    }
  });
  