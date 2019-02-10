var assert = require('assert');

var meetingdetails = require('/Users/jeneki/sites/meetings_manager/resources/assets/js/components/Meetings/partials/MeetingDetails.vue');

describe('Array', function() {
  describe('#indexOf()', function() {
    it('should return -1 when the value is not present', function() {
      assert.equal([1,2,3].indexOf(4), -1);
    });
  });
});

describe('MeetingDetails', function() {
  it('component should return meeting name', function() {
      assert.equal(meetingdetails(), 'Meeting Name'); 
  });
});
