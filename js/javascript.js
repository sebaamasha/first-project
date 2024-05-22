
       
function insertToCategoryMenu(data) {
    const filterButtonsContainer = document.getElementById("filter-buttons");
    for (const key in data.genre) {
    const button = document.createElement("button");
      const category = data.genre[key];
      button.textContent = category;
      const sHtml = `<a href='index.php?genre=${category}'>${category}</a>`;
      button.innerHTML = sHtml;
      filterButtonsContainer.appendChild(button);
    }
    document.getElementById("filter-buttons").appendChild(filterButtonsContainer);
  }
  
  fetch("data/genre.json")
    .then(response => response.json())
    .then(data => insertToCategoryMenu(data))
    .catch(error => {
      console.error("Error fetching JSON data:", error);
    });



    