
function searchTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const table = document.querySelector("table");
    const trs = table.getElementsByTagName("tr");

    // Loop through all table rows, excluding the header
    for (let i = 1; i < trs.length; i++) {
        const tds = trs[i].getElementsByTagName("td");
        let rowContainsFilter = false;

        // Loop through all cells in the row
        for (let j = 0; j < tds.length; j++) {
            const td = tds[j];
            if (td && td.textContent.toLowerCase().includes(filter)) {
                rowContainsFilter = true;
                break;
            }
        }

        // Show or hide the row based on search
        trs[i].style.display = rowContainsFilter ? "" : "none";
    }
}

