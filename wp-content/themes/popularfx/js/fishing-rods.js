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

let termArray = [];

function updateArrays(){
termArray = jQuery('.modal-filters-btn[id^="filter-term-"].active')
.map(function () {
    return this.id.replace("filter-term-", "");
})
    .get();
}

jQuery(".modal-filters-btn").on("click", function () {
    jQuery(this).toggleClass("active");
    updateArrays();
});



           
