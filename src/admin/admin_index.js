function openTab(curTabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(curTabName).style.display = "block";
  // document.querySelector("[onclick=\"openTab('" + curTabName + "')\"]");
}

function logout() {
  localStorage.setItem("activeTab", "defaultOpen");;
  window.location.href = "../login/logout.php";
}

// Function to convert table cell to input field for editing
function editProduct(id) {
  const tr = $(`tr[data-id="${id}"]`);
  tr.find(".editable").each(function () {
    const input = $("<input>").attr("type", "text").val($(this).text());
    $(this).html(input);
  });
  tr.find(".edit-btn").text("Save").attr("onclick", `saveProduct(${id})`);
}

// Function to convert input field back to table cell after saving
function saveProduct(id) {
  const tr = $(`tr[data-id="${id}"]`);
  const data = {
    name: tr.find(".name").find("input").val(),
    price: tr.find(".price").find("input").val(),
    available: tr.find(".available").find("input").val(),
    description: tr.find(".description").find("input").val(),
    cost_price: tr.find(".cost_price").find("input").val(),
    discount: tr.find(".discount").find("input").val(),
    return_policy: tr.find(".return_policy").find("input").val(),
  };

  if (
    !data.name ||
    !data.price ||
    !data.available ||
    !data.description ||
    !data.return_policy ||
    !data.cost_price
  ) {
    alert("Error: Required field cannot be empty");
    return;
  }

  // check price
  if (data.price.startsWith("$")) {
    data.price = data.price.slice(1); // Remove the dollar sign
  }
  if (Number(data.price) < 0) {
    alert("Error: Price can not be negative.");
    return;
  }
  // check cost price
  if (data.cost_price.startsWith("$")) {
    data.cost_price = data.cost_price.slice(1); // Remove the dollar sign
  }
  if (Number(data.cost_price) < 0) {
    alert("Error: Cost Price can not be negative.");
    return;
  }

  //check discount
  if (data.discount.endsWith("%")) {
    data.discount = data.discount.slice(0, -1);
  }
  const discountNumber = parseFloat(data.discount);
  if (discountNumber < 0 || discountNumber > 100 || isNaN(discountNumber)) {
    alert("Invalid discount. Discount must be a number between 0 and 100.");
    return;
  }

  $.post(`../products/update_product.php?id=${id}`, data, function (response) {
    var discountedPrice = data.price * (1 - data.discount / 100);
    var formattedPrice = discountedPrice.toFixed(2);
    var final_price = parseFloat(formattedPrice.replace(",", ""));
    var sellPriceCell = tr.find(".sell_price");
    sellPriceCell.text("$" + final_price);
    tr.find(".editable").each(function () {
      const input = $(this).find("input");
      const value = input.val();
      const isPrice = $(this).hasClass("price");
      const isDiscount = $(this).hasClass("discount");
      const isCostPrice = $(this).hasClass("cost_price");

      if (isPrice && value && !value.startsWith("$")) {
        input.val("$" + value);
      }

      if (isCostPrice && value && !value.startsWith("$")) {
        input.val("$" + value);
      }

      if (isDiscount && value) {
        if (!value.endsWith("%")) {
          input.val(value + "%");
        } else {
          input.val(value);
        }
      }

      $(this).html(input.val());
    });
    tr.find(".edit-btn").text("Edit").attr("onclick", `editProduct(${id})`);
  }).done(function () {
    location.reload();
  });
}

// function to handle the product deletion
function deleteProduct(id) {
  if (confirm("Are you sure you want to delete this product?")) {
    $.post(
      `../products/delete_product.php`,
      { product_id: id },
      function (response) {
        const tr = $(`tr[data-id="${id}"]`);
        tr.remove();
      }
    )
      .done(function () {
        location.reload();
      })
      .fail(function () {
        alert("An error occurred while deleting the product.");
      });
  }
}

// function to handle the product archive
function processArchive(id, archive) {
  var confirm_message = "";
  if (archive) {
    confirm_message = confirm("Are you sure you want to archive this product?");
  } else {
    confirm_message = confirm(
      "Are you sure you want to move this product back to?"
    );
  }
  if (confirm_message) {
    $.post(
      `../products/process_archive.php`,
      { product_id: id, archive: archive },
      function (response) {
        const tr = $(`tr[data-id="${id}"]`);
        tr.remove();
      }
    )
      .done(function () {
        location.reload();
      })
      .fail(function () {
        alert("An error occurred while archiving the product.");
      });
  }
}

function handleCheckboxClick(checkbox, purchase_id) {
  if (
    confirm(
      "Please confirm to ship this product. You cannot cancel this action."
    )
  ) {
    $.post(`../products/ship_product.php`, { purchase_id: purchase_id })
      .done(function () {
        checkbox.checked = true;
        checkbox.disabled = true;
        location.reload();
      })
      .fail(function () {
        alert("An error occurred while updating the product.");
      });
  } else {
    checkbox.checked = false;
  }
}

// Function to save the current active tab to local storage
function saveActiveTab(tabName) {
  localStorage.setItem("activeTab", tabName);
}

// Function to load the saved active tab from local storage and open it
function loadActiveTab() {
  const activeTab = localStorage.getItem("activeTab");
  if(activeTab === "loginTab" || activeTab === "registerTab"){
    document.getElementById("defaultOpen").click();
  }else{
    if (activeTab) {
      document.getElementById(activeTab).click();
    } else {
      document.getElementById("defaultOpen").click();
    }
  }
}

// Add an event listener to save the active tab when a tab is clicked
document.querySelectorAll(".tablink").forEach((tab) => {
  tab.addEventListener("click", function () {
    saveActiveTab(this.id);
  });
});

// add function to cancel a purchase
function cancelPurchase(purchase_id) {
  if (confirm("Are you sure you want to cancel this order?")) {
    $.post(
      `../purchases/cancel_purchase.php`,
      { purchase_id: purchase_id },
      function (response) {
        const tr = $(`tr[data-id="${purchase_id}"]`);
        tr.remove();
      }
    )
      .done(function () {
        location.reload();
      })
      .fail(function () {
        alert("An error occurred while cancelling the purchase.");
      });
  }
}

// Show the review form
function showReviewForm(purchaseId) {
  document.getElementById("reviewFormContainer").style.display = "block";
  document.getElementById("purchaseId").value = purchaseId;
}

// Load the active tab when the page is fully loaded
window.addEventListener("load", loadActiveTab);

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
    fetch("../price/price_history.php?product_id=" + productId)
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        // Process the fetched data and create the Chart.js chart
        chart = createPriceHistoryChart(data);
      })
      .catch(function (error) {
        console.error("Error fetching price history:", error);
      });
  }

  function createPriceHistoryChart(priceHistoryData) {
    var dates = priceHistoryData.map(function (entry) {
      return moment(entry.created_at, "YYYY-MM-DD HH:mm:ss").toDate();
    });

    var prices = priceHistoryData.map(function (entry) {
      return entry.price;
    });

    var ctx = document.getElementById("priceHistoryChart").getContext("2d");

    var newChart = new Chart(ctx, {
      // Create a new Chart.js chart object
      type: "line",
      data: {
        labels: dates,
        datasets: [
          {
            label: "Price History",
            data: prices,
            borderColor: "rgba(75, 192, 192, 1)",
            fill: false,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            type: "time",
            time: {
              unit: "day",
              tooltipFormat: "MMM D", // Format for tooltip display
              displayFormats: {
                day: "MMM D",
              },
            },
            title: {
              display: true,
              text: "Date",
            },
          },
          y: {
            title: {
              display: true,
              text: "Price ($)",
            },
          },
        },
      },
    });

    return newChart; // Return the newly created chart
  }
});

function closeModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "none";
}