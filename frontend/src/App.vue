<template>
  <div class="app-container">
    <h2>Currency Conversion</h2>
    <div class="input-area">
      <div class="input-wrapper">
        <span class="currency-symbol">$</span>
        <input
          type="number"
          v-model="amount"
          @input="handleInput"
          class="amount-input"
        />
      </div>
      <div class="currency-label">USD</div>
      <img :src="`/flags/USD.png`" alt="flag" class="flag-img" />
    </div>

    <div class="rate-list">
      <div
        v-for="rate in rates"
        :key="rate.code"
        class="rate-item"
      >
        <div class="rate-info">
          <img :src="`/flags/${rate.code}.png`" alt="flag" class="flag-img" />
          <span class="rate-code">{{ rate.code }}</span>
          <span class="rate-amount">
            {{ rate.loading ? 'Loading...' : rate.symbol + formatAmount(rate.convertedAmount) }}
          </span>
        </div>
        <div class="rate-description">
          1 USD = {{ rate.loading ? 'Loading...' : rate.rate }} {{ rate.code }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const amount = ref(100)
const rates = ref([
  { code: 'AUD', symbol: '$', rate: 0, convertedAmount: 0, loading: true, },
  { code: 'CAD', symbol: '$', rate: 0, convertedAmount: 0, loading: true, },
  { code: 'JPY', symbol: '¥', rate: 0, convertedAmount: 0, loading: true, },
  { code: 'GBP', symbol: '£', rate: 0, convertedAmount: 0, loading: true, },
  { code: 'NZD', symbol: '$', rate: 0, convertedAmount: 0, loading: true, },
])

let timeoutId = null
const API_URL = 'https://openexchangerates.org/api/latest.json'
const APP_ID = import.meta.env.VITE_OPENEXCHANGE_KEY

async function fetchRates() {
  try {
    const response = await axios.get(API_URL + `?app_id=${APP_ID}`)
    if (response.status !== 200) {
      throw new Error()
    }

    const data = response.data.rates
    rates.value = rates.value.map((rate) => ({
      ...rate,
      rate: data[rate.code],
      convertedAmount: amount.value * data[rate.code],
      loading: false,
    }))
    
  } catch (error) {
    console.error('Failed to fetch rates:', error)
  }
}

function handleInput() {
  clearTimeout(timeoutId)
  timeoutId = setTimeout(() => {
    rates.value = rates.value.map(rate => ({
      ...rate,
      loading: true,
    }))
    fetchRates()
  }, 500)
}

function formatAmount(value) {
  return `${value.toFixed(2)}`
}

fetchRates()

watch(amount, fetchRates)
</script>

<style scoped>
.app-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  text-align: center;
  font-size: 1.5rem;
  margin-bottom: 20px;
}

.input-area {
  display: flex;
  flex-direction: row-reverse;
  align-items: center;
  gap: 8px;
  margin-bottom: 30px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.currency-label {
  font-weight: bold;
  flex-shrink: 0;
  text-align: left;
  min-width: 36px;
}

.input-wrapper {
  display: flex;
  align-items: center;
  flex-grow: 1;
  justify-content: flex-end;
}

.currency-symbol {
  font-size: 1rem;
  font-weight: bold;
  color: #333;
}

.amount-input {
  padding: 8px;
  border: none;
  border-radius: 4px;
  font-size: 1.2rem;
  font-weight: bold;
  text-align: right;
  color: #333;
  background-color: transparent;
  width: auto;
  max-width: 90px;
}

.rate-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.rate-item {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 12px;
  background-color: #f9f9f9;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.rate-info {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.flag-img {
  width: 24px;
  height: 24px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 8px;
}

.rate-code {
  font-weight: bold;
  font-size: 1rem;
  margin-right: auto;
}

.rate-amount {
  font-weight: bold;
  font-size: 1rem;
}

.rate-description {
  font-size: 0.75rem;
  color: #777;
  text-align: right;
  margin-top: 4px;
}
</style>
