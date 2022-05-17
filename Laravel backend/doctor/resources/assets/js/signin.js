/**
 * [readURL :Read image data]
 * @param  {[file]} input [description]
 * @return {[type]}       [description]
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image_upload_preview').removeClass('hide').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

(function() {
    // Picture change event on signup page
    $("#signup-pic").on("change", () => readURL(this));

    $("a.switchVisibility").on("click", () => {
        let $this = $(this),
            ref = $this.data('ref');
        activeClass = $(`div.${ref}`);
        activeClass.removeClass('hide').addClass('animated flipInY').delay(3000).removeClass('flipOutY');
        activeClass.siblings('div.auth-wrap')
            .addClass('animated flipOutY').delay(3000).addClass('hide').removeClass('flipInY');
    });

    /**
     * [Spinner on Login click]
     */
    $('.mm-btn').on("click", () => {
        let $this = $(this);
        let preloader = $this.data('preloader') ? $this.data('preloader') : 'teal';
        let setText = $this.data('text') ? $this.data('text') : $this.text();
        let setIcon = $this.data('icon') ? $this.data('icon') : '';
        let iconPos = ($this.data('iconPos') && setIcon != '') ? $this.data('iconPos') : 'right';
        let redirectionPoint = $this.data('redirection') ? $this.data('redirection') : '';
        $this.text('');
        let setHtml = `<div class="preloader-wrapper small active">
				<div class="spinner-layer spinner-${preloader}-only">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div><div class="gap-patch">
						<div class="circle"></div>
					</div><div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>`;
        $this.addClass('btn-floating white').html(setHtml);
        setTimeout(() => {
            if (setIcon != '') {
                var textCont = `${setText} <i class="material-icons white-text ${iconPos}">${setIcon}</i>`;
                $this.removeClass('btn-floating white').empty().html(textCont);
            } else {
                $this.removeClass('btn-floating white').empty().text(setText);
            }
            if (redirectionPoint != '') {
                window.location.href = "./index.html";
            }
        }, 5000);
    });
})();