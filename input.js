document.addEventListener("DOMContentLoaded", () => {
    let list = document.querySelectorAll('.list-tab-pane-click');
    let content = document.querySelector('#content-tab-pane-result');
    let data = content.querySelectorAll('div[data-target-tab-pane-result]');
    let searchData = content.querySelectorAll('div[data-target-tab-name-result]');
    let searchBar = document.getElementById("searchBar");
    list.forEach(node => {
        node.addEventListener('click', () => {
            content.setAttribute("data-cat-tab-pane-result", `${node.id}`);
            let label = content.getAttribute("data-cat-tab-pane-result");
            let count = 0;
            data.forEach(item => {
                item.style.display = 'none';
                if (node.id === 'all') {
                    item.style.display = 'block';
                    count++;
                }
                if (item.getAttribute('data-target-tab-pane-result') === node.id) {
                    item.style.display = 'block';
                    count++;
                }

            })
        })
    })
    searchBar.addEventListener('input', () => {
        const value = searchBar.value.trim();
        searchData.forEach(ss => {
            ss.style.display = 'none';
            let d1 = ss.querySelector(".name");
            if (d1.textContent.includes(value)) {
                ss.style.display = 'block';
            }
        })
    })

})