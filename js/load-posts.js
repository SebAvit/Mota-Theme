// Front Page Load More Posts
var front_page = 1;
var alreadyDisplayedPosts = [];
// Add Post IDs -> alreadyDisplayedPosts each load posts
function updateAlreadyDisplayedFrontPosts() {
    $(".section_photo_block_container .photo_block").each(function () {
        const postId = $(this).data("post-id");
        if (alreadyDisplayedPosts.indexOf(postId) === -1) {
            alreadyDisplayedPosts.push(postId);
        }
    });
}

jQuery(function ($) {
    // Call the function Posts IDs
    updateAlreadyDisplayedFrontPosts();
    $("body").on("click", ".btn_load_more", function () {
        var data = {
            action: "load_front_posts_by_ajax",
            page: front_page,
            security: photo.security,
            posts_per_page: photo.posts_per_page,
            exclude: alreadyDisplayedPosts.join(","),
        };

        $.post(photo.ajaxurl, data, function (response) {
            if ($.trim(response) != "") {
                $("#section_result_filtered").append(response);
                updateLightboxArray();
                updateAlreadyDisplayedFrontPosts();
                front_page++;
            } else {
                $(".btn_load_more").hide();
            }
        });
    });
});

// Single Page Load All Posts
var single_page;
var alreadyDisplayedSinglePosts = [];
// Add Post IDs -> alreadyDisplayedPosts each load posts
function updateAlreadyDisplayedSinglePosts() {
    $(".post_other_imgs_container .photo_block").each(function () {
        const postId = $(this).data("post-id");
        if (alreadyDisplayedPosts.indexOf(postId) === -1) {
            alreadyDisplayedPosts.push(postId);
        }
    });
}

jQuery(function ($) {
    // Call the function Posts IDs
    updateAlreadyDisplayedSinglePosts();
    $("body").on("click", ".btn_load_all_imgs", function () {
        var data = {
            action: "load_single_posts_by_ajax",
            page: single_page,
            security: photo.security,
            exclude: alreadyDisplayedPosts.join(","),
        };

        $.post(photo.ajaxurl, data, function (response) {
            if ($.trim(response) != "") {
                $(".post_other_imgs_container").append(response);
                updateLightboxArray();
                updateAlreadyDisplayedSinglePosts();
                single_page++;
            } else {
                $(".btn_load_all_imgs").hide();
            }
        });
    });
});
// Display None Section Btn Load More Front Page
$(document).ready(function () {
    const sectionBtnLoadMoreImgs = $(".div_btn_load_more");
    const btnLoadMoreImgs = $(".btn_load_more");

    function displayNoneSectionBtn(el) {
        btnLoadMoreImgs.on("click", function () {
            el.hide();
        });
    }

    displayNoneSectionBtn(sectionBtnLoadMoreImgs);
});
// Display None Section Btn Load All Single Page
$(document).ready(function () {
    const sectionBtnLoadAllImgs = $(".section_btn_load_all_imgs");
    const btnLoadAllImgs = $(".btn_load_all_imgs");

    function displayNoneSectionBtn(el) {
        btnLoadAllImgs.on("click", function () {
            el.hide();
        });
    }

    displayNoneSectionBtn(sectionBtnLoadAllImgs);
});