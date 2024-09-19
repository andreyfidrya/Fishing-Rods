function initializeModalFiltersCategory(){
    const $document = jQuery(document);
    const $backdrop = jQuery("#filters_backdrop");
    const $modal = jQuery("#filters_modal");

    function openModal() {
    $backdrop.fadeIn();
    $modal.addClass("open");
    }		

    $document.on("click", "#open_modal_filters_category", openModal);

    function closeModal() {
    $backdrop.fadeOut();
    $modal.removeClass("open");			
    }

    $document.on("click", "#close_modal_filters_category", closeModal);
    }
initializeModalFiltersCategory();

let lengthArray = [];
let testArray = [];

function updateArrays(){

lengthArray = jQuery('.modal-filters-btn[id^="filter-length-"].active')
.map(function () {
    return this.id.replace("filter-length-", "");
})
    .get();

testArray = jQuery('.modal-filters-btn[id^="filter-test-"].active')
.map(function () {
    return this.id.replace("filter-test-", "");
})
    .get();

}

jQuery(".modal-filters-btn").on("click", function () {
    jQuery(this).toggleClass("active");
    updateArrays();
});

jQuery("#filter_modal_reset").on("click", function () {
    jQuery(".modal-filters-btn").removeClass("active");
    updateArrays();
});



           
