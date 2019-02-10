import { expect } from 'chai'
import { mount } from '@vue/test-utils'
import MeetingDetails from '/Users/jeneki/sites/meetings_manager/resources/assets/js/components/Meetings/partials/MeetingDetails.vue'

describe('MeetingDetails.vue', () => {
    describe('classes', () => {
        it('component should have a padding class', () => {
            const wrapper = mount(MeetingDetails)
            expect(wrapper.is('.padding-15')).to.equal(true)
          })
    })
})