//******************************************
// Change REGION
//******************************************

//   var regionList = [];
//   var regionValue = localStorage.getItem("region");
//   var testRegion = document.cookie.match(/^(.*;)?\s*site_region\s*=\s*[^;]+(.*)?$/);
//   var testSort = document.cookie.match(/^(.*;)?\s*archive_sort\s*=\s*[^;]+(.*)?$/);
//
//   //Add each region into the array
//   $(".region__container option").each(function() {
//     var item = $(this).val();
//     regionList.push(item);
//   });
//
//   //Remove region class from html tag
//   $("html").removeClass(regionList.join(" "));
//
//
//   // Set default region
//   if (regionValue == null) {
//     localStorage.setItem("region", 'can');
//     var regionValue = localStorage.getItem("region");
//   }
//
//   //ensure cookie is set
//   if (testRegion == null) {
//     document.cookie = 'site_region=' + regionValue;
//     location.reload();
//     }
//
//   addRegionInfo(regionValue);
//
//   $(".region__container").on("change", function() {
//     var newRegion = $(this).val();
//     $("html").removeClass(regionList.join(" "));
//     localStorage.removeItem("region");
//     addRegionInfo(newRegion);
//     location.reload();
//   });
//
//
//   //add values to html tag and flag
//   function addRegionInfo(region) {
//     $(".region__container").val(region);
//     $("html").addClass(region);
//     $(".region-flag__display").attr("src", "https://www.alter-verse.com/wp-content/uploads/2019/04/region-" + region + ".jpg");
//     localStorage.setItem("region", region);
//     document.cookie = 'site_region=' + region;
//   }
//
//
// //******************************************
// // Sort Filter
// //******************************************
//
// // if (testSort == null) {
// //   document.cookie = 'archive_sort=feature';
// //   location.reload();
// //   }
//
// $(".av_filter__sort input").on("change", function() {
//   document.cookie = 'archive_sort=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
//   var value = $(this).val();
//   document.cookie = 'archive_sort=' + value;
//   location.reload();
// });
//
//
// //******************************************
// // Homepage Model Filter
// //******************************************
//
// function filter(make) {
//   document.cookie = 'archive_sort=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
//   document.cookie = 'archive_sort=' + make;
// }
// console.log(document.cookie);









var testRegion = document.cookie.replace(/(?:(?:^|.*;\s*)site_region\s*\=\s*([^;]*).*$)|^.*$/, "$1");
var testSort = document.cookie.replace(/(?:(?:^|.*;\s*)archive_sort\s*\=\s*([^;]*).*$)|^.*$/, "$1");

$('.sort_' + testSort).css('background-color', '#000');
console.log('.sort_' + testSort);

//ensure cookie is set
if (testRegion == '') {
  document.cookie = 'site_region=can;path=/;domain=alter-verse.com';
  location.reload();
  } else {
  addRegionInfo(testRegion);
}

//add new region to cookie
function addRegionInfo(region) {
  $(".region__container").val(region);
  document.cookie = 'site_region=' + region + ';path=/;domain=alter-verse.com';
}


$(".region__container").on("change", function() {
  var newRegion = $(this).val();
  addRegionInfo(newRegion);
  location.reload();
});





//******************************************
// Sort Filter
//******************************************


$(".av_filter__sort input").on("change", function() {
  var value = $(this).val();
  document.cookie = 'archive_sort=' + value + ';path=/;domain=alter-verse.com';
  location.reload();
  });

//******************************************
// Homepage Model Filter
//******************************************

function filter(make) {
  document.cookie = 'archive_sort=' + make + ';path=/;domain=alter-verse.com';
}

console.log('This is the sort that us being used: ' + testRegion);
console.log('This is the sort that us being used: ' + testSort);
