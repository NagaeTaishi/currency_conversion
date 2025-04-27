import { mount } from '@vue/test-utils'
import App from '@/App.vue'

describe('App.vue', () => {
  it('can be mounted', () => {
    const wrapper = mount(App)
    expect(wrapper.exists()).toBe(true)
  })

  it('displays "Convert" initially', () => {
    const wrapper = mount(App)
    expect(wrapper.text()).toContain('Convert')
  })

  it('has an input field for USD', () => {
    const wrapper = mount(App)
    const input = wrapper.find('input[type="number"]')
    expect(input.exists()).toBe(true)
  })

  it('shows "Loading" when USD is entered', async () => {
    const wrapper = mount(App)

    const input = wrapper.find('input[type="number"]')
    await input.setValue(200)

    // Wait for debounce
    await new Promise(resolve => setTimeout(resolve, 600))

    // Check if "Loading" is displayed
    expect(wrapper.text()).toContain('Loading...')
  })

  it('displays converted rates after loading', async () => {
    const wrapper = mount(App)

    const input = wrapper.find('input[type="number"]')
    await input.setValue(200)

    // Wait for debounce and mock API response
    await new Promise(resolve => setTimeout(resolve, 600))

    // Mock converted rates (you may need to mock API calls in your setup)
    expect(wrapper.text()).toContain('1 USD =')
  })

  it('shows an error modal when an error occurs', async () => {
    const wrapper = mount(App)

    // Simulate an error state
    await wrapper.setData({
      showErrorModal: true,
      errorMessage: 'Failed to fetch rates',
    })

    // Check if the modal is displayed with the correct message
    expect(wrapper.find('.modal').exists()).toBe(true)
    expect(wrapper.text()).toContain('Failed to fetch rates')
  })
})
