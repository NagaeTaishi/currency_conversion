<template>
  <div class="app-container">
    <h1>Convert</h1>

    <div class="input-area">
      <div class="currency-label">USD</div>
      <input
        type="number"
        v-model="amount"
        class="amount-input"
      />
    </div>

    <div class="rate-list">
      <div
        v-for="rate in rates"
        :key="rate.code"
        class="rate-item"
      >
        <div class="rate-info">
          <span>{{ rate.code }}</span>
          <span>{{ rate.loading ? 'Loading...' : rate.symbol + rate.convertedAmount }}</span>
        </div>
        <div class="rate-description">
          1 USD = {{ rate.loading ? 'Loading...' : rate.rate }} {{ rate.code }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const amount = ref(100)
const rates = ref([
  { code: 'AUD', symbol: '$', rate: 0, convertedAmount: 0, loading: true },
  { code: 'CAD', symbol: '$', rate: 0, convertedAmount: 0, loading: true },
  { code: 'EUR', symbol: '€', rate: 0, convertedAmount: 0, loading: true },
  { code: 'GBP', symbol: '£', rate: 0, convertedAmount: 0, loading: true },
  { code: 'NZD', symbol: '$', rate: 0, convertedAmount: 0, loading: true },
])
</script>

<style scoped>
.input-area {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 20px;
}

.currency-label {
  background: #eee;
  padding: 8px 12px;
  border-radius: 4px;
  font-weight: bold;
}

.amount-input {
  flex: 1;
  padding: 8px;
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
}

.rate-info {
  display: flex;
  justify-content: space-between;
  font-weight: bold;
}

.rate-description {
  font-size: 0.8rem;
  color: #777;
}
</style>
