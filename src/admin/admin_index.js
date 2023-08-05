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
    document.querySelector('[onclick="openTab(\'' + tabName + '\')"]');
}


function logout() {
  window.location.href = "../login/logout.php";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


// Function to convert table cell to input field for editing
function editProduct(id) {
    const tr = $(`tr[data-id="${id}"]`);
    tr.find('.editable').each(function() {
        const input = $('<input>').attr('type', 'text').val($(this).text());
        $(this).html(input);
    });
    tr.find('.edit-btn').text('Save').attr('onclick', `saveProduct(${id})`);
}

// Function to convert input field back to table cell after saving
function saveProduct(id) {
      const tr = $(`tr[data-id="${id}"]`);
      const data = {
          name: tr.find('.name').find('input').val(),
          price: tr.find('.price').find('input').val(),
          available: tr.find('.available').find('input').val(),
          sold: tr.find('.sold').find('input').val(),
          returns_policy: tr.find('.return_policy').find('input').val()
      };
      // Check if any required fields are empty
      if (!data.name || !data.price || !data.available || !data.sold || !data.returns_policy) {
        alert("Error: Required field cannot be empty");
        return;
      }

      // check price is a number
      if (data.price && data.price.startsWith('$')) {
        data.price = data.price.slice(1); // Remove the dollar sign
      }
      // check price is a negative number
      if (Number(data.price) < 0) {
        alert("Error: Price can not be negative.");
        return;
      }
      
      $.post(`../products/update_product.php?id=${id}`, data, function(response) {
          tr.find('.editable').each(function() {
            const input = $(this).find('input');
            const value = input.val();
            const isPrice = $(this).hasClass('price');
          
            if (isPrice && value && !value.startsWith('$')) {
              input.val('$' + value);
            }
          
            $(this).html(input.val());
          });
          tr.find('.edit-btn').text('Edit').attr('onclick', `editProduct(${id})`);
      });
}

// function to handle the product deletion
function deleteProduct(id) {
  if (confirm("Are you sure you want to delete this product?")) {
    $.post(`../products/delete_product.php`, { product_id: id }, function(response) {
      const tr = $(`tr[data-id="${id}"]`);
      tr.remove();
    })
    .fail(function() {
      alert("An error occurred while deleting the product.");
    });
  }
}


// function deleteProduct(id){
//   if (confirm("Are you sure you want to delete this product?")) {
//     $.ajax({
//         type: "POST",
//         url: "delete_product.php",
//         data: { product_id: productId },
//         success: function(response) {
//             // Refresh the page to update the product list after deletion
//             location.reload();
//         },
//         error: function() {
//             alert("An error occurred while deleting the product.");
//         }
//     });
//   }

// }