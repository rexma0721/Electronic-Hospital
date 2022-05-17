var loaderBody=$('body');
function loadHula(){
		loaderBody.prepend('<div class="app_loader animated"><div class="mat2-load"></div></div>');
}
loadHula();
$(function() {
	setTimeout(function(){
		loaderBody.find('div.app_loader').addClass("flipOutY");
	},3000);
	setTimeout(function(){
		loaderBody.find('div.app_loader').remove();
	},4000);
});