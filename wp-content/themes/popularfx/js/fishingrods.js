/**
 * File fishingrods.js 
 */

// для инициализации модального окна категории с фильтрами
function initializeModalFiltersCategory() {
    const $document = jQuery(document);
    const $pageBodyFishingRods = jQuery("#page_body_nespresso");
    const $backdrop = jQuery("#filters_backdrop");
    const $modal = jQuery("#filters_modal");

    function openModal() {
      $backdrop.fadeIn();
      $modal.addClass("open");
      $document.on("keyup", onEscKeyPress);
      $pageBodyFishingRods.addClass("no-scroll");      
    }

    function closeModal() {
      $modal.removeClass("open");
      $backdrop.fadeOut();
      $document.off("keyup", onEscKeyPress);
      $pageBodyNespresso.removeClass("no-scroll");
    }

    function onEscKeyPress(e) {
      if (e.key === "Escape") {
        closeModal();
      }
    }

    $document.on("click", "#open_modal_filters_category", openModal);

    $backdrop.click(function (e) {
      if (e.target === this) {
        closeModal();
      }
    });

    $document.on("click", "#close_modal_filters_category", closeModal);
  }