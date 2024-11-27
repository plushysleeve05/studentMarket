// customer_profile.js

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

// Function to load content for the selected section
function loadSectionContent(section) {
  const sectionDetails = document.querySelector(".section-details");
  let content = "";

  switch (section) {
    case "order_history":
      content = `
                <h3>Order History</h3>
                <p>View and track your previous orders.</p>
                <div class="order-history-table">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Item</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1234</td>
                                <td>Wireless Headphones</td>
                                <td>Nov 15, 2024</td>
                                <td>Delivered</td>
                                <td><a href="#" class="track-order">Track Order</a></td>
                            </tr>
                            <!-- Add more rows here as needed -->
                        </tbody>
                    </table>
                </div>

            `;
      break;
    case "gift_cards":
      content = `
                <h3>Gift Cards</h3>
                <p>Manage your gift cards and check available balances.</p>
                <div class="gift-card">
                    <p>Gift Card Balance: $50.00</p>
                    <a href="#" class="edit-info">Redeem</a>
                </div>
            `;
      break;
    default:
      content = `
                <h3>Personal Student Information</h3>
                <p>Manage your personal information, including phone numbers and email addresses where you can be contacted.</p>
                <div class="info-cards">
                    <div class="info-card">
                        <h4>Name</h4>
                        <p>John Doe</p>
                        <a href="#" class="edit-info">Edit</a>
                    </div>
                    <div class="info-card">
                        <h4>Date of Birth</h4>
                        <p>07 July 1993</p>
                        <a href="#" class="edit-info">Edit</a>
                    </div>
                    <div class="info-card">
                        <h4>Country/Region</h4>
                        <p>USA, New York</p>
                        <a href="#" class="edit-info">Edit</a>
                    </div>
                    <div class="info-card">
                        <h4>Language</h4>
                        <p>English (US)</p>
                        <a href="#" class="edit-info">Edit</a>
                    </div>
                    <div class="info-card">
                        <h4>Contactable at</h4>
                        <p>johndoe@example.com</p>
                        <a href="#" class="edit-info">Edit</a>
                    </div>
                </div>
            `;
  }

  sectionDetails.innerHTML = content;
}

// Initialize the profile page functions after the DOM content has loaded
document.addEventListener("DOMContentLoaded", initializeProfilePage);
