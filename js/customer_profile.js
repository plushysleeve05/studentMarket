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
      const sectionId =
        event.target.getAttribute("href").split("=")[1] + "-section";
      showSelectedSection(sectionId);
    });
  });
}

// Function to show the selected section and hide others
function showSelectedSection(sectionId) {
  const allSections = document.querySelectorAll(".section-details > div");

  // Hide all sections
  allSections.forEach((section) => {
    section.style.display = "none";
  });

  // Show the selected section
  const selectedSection = document.getElementById(sectionId);
  if (selectedSection) {
    selectedSection.style.display = "block";
  } else {
    console.error(`Section with ID '${sectionId}' not found.`);
  }
}

// Initialize the profile page functions after the DOM content has loaded
document.addEventListener("DOMContentLoaded", initializeProfilePage);
