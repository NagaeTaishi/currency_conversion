<template>
  <div class="app-container">
    <h1>Convert</h1>

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
    </div>

    <div class="rate-list">
      <div
        v-for="rate in rates"
        :key="rate.code"
        class="rate-item"
      >
        <div class="rate-info">
          <span>{{ rate.code }}</span>
          <span>{{ rate.loading ? 'Loading...' : rate.symbol + formatAmount(rate.convertedAmount)}}</span>
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
  { code: 'EUR', symbol: '€', rate: 0, convertedAmount: 0, loading: true, },
  { code: 'GBP', symbol: '£', rate: 0, convertedAmount: 0, loading: true, },
  { code: 'NZD', symbol: '$', rate: 0, convertedAmount: 0, loading: true, },
])

let timeoutId = null

async function fetchRates() {
  try {
    const data = {
      AUD: 1.5,
      CAD: 1.3,
      EUR: 0.9,
      GBP: 0.8,
      NZD: 1.6,
    }

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

.input-area {
  display: flex;
  flex-direction: row-reverse;
  align-items: center;
  gap: 8px;
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
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
  font-size: 1rem;
  font-weight: bold;
  text-align: right;
  color: #333;
  background-color: transparent;
  width: auto;
  min-width: 4ch;
  max-width: 120px;
}

.rate-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.rate-item {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
}

.rate-info {
  display: flex;
  justify-content: space-between;
  font-weight: bold;
}

.rate-description {
  font-size: 0.8rem;
  color: #777;
  text-align: right;
}
</style>
