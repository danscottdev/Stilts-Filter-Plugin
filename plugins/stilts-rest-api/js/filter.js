
// REST API FILTER FUNCTIONALITY
// uses utility functions stored in /filter-utilities.js, accessed via {filterUtilites.fn}


/*
  - #Globals
  - #BuildRoute()
  - #RunFilter()
  - #Search()
  - #PopulateData()
  - #LoadMore()
*/

// #Globals
const container = document.querySelector('#filterResultsContainer');
const loadMoreButton = document.getElementById('loadmore');
const baseURL = '/wp-json';


// #BuildRoute()
// Build URL Query string based on filter & pagination parameters
function buildRoute(postType, filterParameter, filterValue, pagination) {

  let newURL = `${baseURL}/${postType}/all?${filterParameter}=${filterValue}`;

  // Check if pagination & update accordingly
  pagination && (newURL += `&page=${pagination}&`)

  console.log(newURL);
  return newURL;
}


// function handleMapClick(mapID) {
// 	console.log('handleMapClick');
// 	runOrganizationFilter(mapID);
// }





// #RunFilter()
// Function fires every time a filter is changed by the user



function runResourceFilter(filterValue){
    // console.log(filterValue);
    if(filterValue === "All" || filterValue === "Filter By"){
        filterValue = '';
    }
    runFilter('resources', 'category', filterValue);
}


function runFilter(postType, filterParameter, filterValue) {

  // Build REST API route
  let restRoute = buildRoute(postType, filterParameter, filterValue);

  // Hit REST API endpoint & populate results
  fetch(restRoute)
    .then(response => response.json())
    // .then(data => console.log(data));
    .then(data => populateData(data));

  if (loadMoreButton.style.display = "none") {
    loadMoreButton.style.display = "block";
  }

    // Reset Pagination & Search terms when we change filters
    loadMoreButton.dataset.pagenum = 1;
    loadMoreButton.dataset.filtervalue = filterValue;
}




// #PopulateData
// Display results from API fetch request (or 'no more results' message) to page
function populateData(data) {
  container.innerHTML = '';

	if(data.length < 1) {
		loadMoreButton.style.display = 'none';
		if (!document.getElementById('noMoreResults')) {
			let noMoreResultsDiv = document.createElement('span');
          noMoreResultsDiv.id = "noMoreResults";
          noMoreResultsDiv.innerHTML = `
            <div class="load-more-container no-results">
              <button class="wp-block-button white">NO RESULTS FOUND</button>
            </div>
          `;
			container.appendChild(noMoreResultsDiv);

      const scrollElement = document.getElementById('orgResultsContainerScrollPoint');
      scrollElement.scrollIntoView({behavior: "smooth"});

		}
	} else {
		loadMoreButton.style.display = 'block';
		container.innerHTML = data;

    const scrollElement = document.getElementById('orgResultsContainerScrollPoint');
        // Only auto-scroll for organizations page
        if(scrollElement){
            scrollElement.scrollIntoView({behavior: "smooth"});
        }
	}
}




// #LoadMore()
// Pagination for Results - show more when user clicks "Load More"
function loadmore() {

  const postType = loadMoreButton.dataset.posttype;
  const pageNum = loadMoreButton.dataset.pagenum;   // Current "page" number is stored via data-pagenum attribute in button node
  const filterVal = loadMoreButton.dataset.filtervalue || '';
    let filterParam;

  if(postType === "organizations"){
    filterParam = "state";
  } else if (postType == "resources"){
      filterParam = "category";
  }

  console.log(postType, pageNum);
  // Update Query URL for current page number
  let paginationRoute = buildRoute(postType, filterParam, filterVal, pageNum);


  fetch(paginationRoute)
    .then(response => response.json())
    .then(data => {
      // If results are found, add them to the page
      // Otherwise show a "no more results" message"
      data ? container.innerHTML += data : noMoreResults();
    });

  function noMoreResults() {

    // Hide 'load more' button
    loadMoreButton.style.display = 'none';

    // Check if message isn't already displayed, display it
    if (!document.getElementById('noMoreResults')) {
      let noMoreResultsDiv = document.createElement('span');
          noMoreResultsDiv.id = "noMoreResults";
          noMoreResultsDiv.innerHTML = `
            <div class="load-more-container no-results">
              <button class="wp-block-button white">NO MORE RESULTS FOUND</button>
            </div>
          `;
      container.appendChild(noMoreResultsDiv);
    }
  }

  // Increment current page number
  loadMoreButton.dataset.pagenum++;
}