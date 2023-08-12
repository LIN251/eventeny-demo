function openTab(tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(tabName).style.display = "block";
  document.querySelector("[onclick=\"openTab('" + tabName + "')\"]");
}


// Function to save the current active tab to local storage
function saveActiveTab(tabName) {
  localStorage.setItem('activeTab', tabName);
}

// Function to load the saved active tab from local storage and open it
function loadActiveTab() {
  const activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
    document.getElementById(activeTab).click();
  } else {
    document.getElementById('defaultOpen').click();
  }
}

// Add an event listener to save the active tab when a tab is clicked
document.querySelectorAll('.tablink').forEach(tab => {
  tab.addEventListener('click', function() {
    saveActiveTab(this.id);
  });
});

// Load the active tab when the page is fully loaded
window.addEventListener('load', loadActiveTab);

document.addEventListener("DOMContentLoaded", function () {
  var priceHistoryButtons = document.querySelectorAll(".price-history-button");
  var modal = document.getElementById("modal");
  var chart; // Declare the chart variable

  priceHistoryButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      var productId = this.getAttribute("data-product-id");

      // Show modal
      modal.style.display = "block";

      // Destroy the previous chart if it exists
      if (chart) {
        chart.destroy();
      }

      // Fetch and display price history chart
      fetchPriceHistory(productId);
    });
  });

  function fetchPriceHistory(productId) {
    fetch('price/price_history.php?product_id=' + productId)
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        // Process the fetched data and create the Chart.js chart
        chart = createPriceHistoryChart(data); // Assign the chart to the variable
      })
      .catch(function(error) {
        console.error('Error fetching price history:', error);
      });
  }

  function createPriceHistoryChart(priceHistoryData) {
    var dates = priceHistoryData.map(function (entry) {
      return moment(entry.created_at, "YYYY-MM-DD HH:mm:ss").toDate();
    });

    var prices = priceHistoryData.map(function (entry) {
      return entry.price;
    });

    var ctx = document.getElementById('priceHistoryChart').getContext('2d');

    var newChart = new Chart(ctx, { // Create a new Chart.js chart object
      type: 'line',
      data: {
        labels: dates,
        datasets: [{
          label: 'Price History',
          data: prices,
          borderColor: 'rgba(75, 192, 192, 1)',
          fill: false
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            type: 'time',
            time: {
              unit: 'day',
              tooltipFormat: 'MMM D', // Format for tooltip display
              displayFormats: {
                day: 'MMM D'
              }
            },
            title: {
              display: true,
              text: 'Date'
            }
          },
          y: {
            title: {
              display: true,
              text: 'Price ($)'
            }
          }
        }
      }
    });

    return newChart; // Return the newly created chart
  }
});

function closeModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "none";
}