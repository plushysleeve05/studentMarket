// Main function to initialize all necessary event listeners
function initializeProfilePage() {
  setupSidebarLinks();
}

// Function to set up event listeners on sidebar links
function setupSidebarLinks() {
  const sidebarLinks = document.querySelectorAll(".menu-item");

  sidebarLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const section = event.target.getAttribute("href").split("=")[1];
      loadSectionContent(section);
    });
  });
}

// Function to dynamically load content for the selected section via AJAX
function loadSectionContent(section) {
  const sectionDetails = document.querySelector(".section-details");
  sectionDetails.innerHTML = `<p>Loading...</p>`; // Temporary loading indicator

  // Make an AJAX request to fetch content from the backend
  fetch(`get_section_content.php?section=${section}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.text(); // Expect HTML content from the server
    })
    .then((html) => {
      sectionDetails.innerHTML = html; // Replace the content dynamically
    })
    .catch((error) => {
      console.error("Error fetching section content:", error);
      sectionDetails.innerHTML = `<p>Error loading content. Please try again later.</p>`;
    });
}

// Initialize the profile page functions after the DOM content has loaded
document.addEventListener("DOMContentLoaded", initializeProfilePage);
