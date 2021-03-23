// Endless tree structured UL > LI > UL 

$.extend($.expr[":"], {
	"containsIN" : function(elem, i, match, array) {
		return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});

var treefilter = function(el, options) {

	var defaults = {
		offsetLeft : 20, // left offset for each level
		searcher : null, // search input field
		expanded : false, // if true, your list will be show with expanded.
		expanded : false, // if true, your list will be show with expanded.
		multiselect : false // multiselect.
	};

	// Public Variables
	var plugin = this;
	var status = []; // save folder status for "var memory"

	plugin.settings = {};

	// Main Function
	var init = function() {
		plugin.settings = $.extend({}, defaults, options);
		plugin.el = el;

		// set class names to tags
		el.addClass("tf-tree");
		el.find("li").addClass("tf-child-true");
		el.find("li").css("padding-left", plugin.settings.offsetLeft);
		el.find("li div:only-child").parent().removeClass("tf-child-true");
		el.find("li div:only-child").parent().addClass("tf-child-false");

		// if the list has a checkbox, block event bubbling.
		el.find("input[type=checkbox]").click(function(e) {
			e.stopPropagation();
		});

		// set click event.
		el.find("li.tf-child-true").children("div").click(function(e) {
			if (e.metaKey || e.ctrlKey) {
				if ($(this).parent().hasClass("tf-open")) {
					$(this).parent().find("li.tf-child-true").removeClass("tf-open");
				} else {
					$(this).parent().find("li.tf-child-true").addClass("tf-open");
				}
			}
			$(this).parent().toggleClass("tf-open");
		});

		// toggle effect when multiselect enabled.
		el.find("li.tf-child-false").click(function() {
			if (plugin.settings.multiSelect != true) {
				el.find("li.tf-selected").removeClass("tf-selected");
			}
			$(this).toggleClass("tf-selected");
		});

		if (plugin.settings.searcher) {
			searcher();
		}
	};

	// PUBLIC METHOD
	plugin.openAll = function() {
		plugin.el.find("li.tf-child-true").parent().addClass("tf-open");
	};
	plugin.closeAll = function() {
		plugin.el.find("li.tf-child-true").parent().removeClass("tf-open");
	};

	// PRIVATE FUNCTION
	// fired when type on search input field.
	var searcher = function() {
		$(plugin.settings.searcher).keyup(function() {
			if ($(this).val().length == 0) {
				plugin.el.find(".tf-search-result").removeClass("tf-search-result");
				memory("out", status);
			} else {
				plugin.closeAll();
				plugin.el.find("li.tf-open").removeClass("tf-open");
				plugin.el.find("li.tf-search-result").removeClass("tf-search-result");
				plugin.el.find("li:containsIN('" + $(this).val() + "')").addClass("tf-search-result");
				plugin.el.find("li.tf-search-result").parent().addClass("tf-search-result");
			}
		});
		$(plugin.settings.searcher).keydown(function() {
			if ($(this).val().length == 0) {
				memory("in", status);
			}
		});
	};
	
	// save current status of folder 
	// action : string "in" / "out"
	// array : array that saves current status
	// list : el
	var memory = function(action) {
		if (action == "in") {
			status = [];
			plugin.el.find("li").each(function() {
				status.push($(this).hasClass("tf-open"));
			});
		} else if (action == "out") {
			plugin.el.find("li").each(function(i) {
				if (status[i]) { 
					$(this).addClass("tf-open");
				} else {
					$(this).removeClass("tf-open");
				}
			});
		}
	}

	init();
};