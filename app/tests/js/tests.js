/**
 * Test Cases for JavaScript
 */

var injector = angular.injector(['ng', 'divulgaUsadosApp']);

var init = {
	setup: function() {
		this.$scope = injector.get('$rootScope').$new();
    }
};

module('tests', init);

test( "hello test", function() {
  ok( 1 == "1", "Passed!" );
});