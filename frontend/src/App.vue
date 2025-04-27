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
  </div>
</template>

<script setup>
import { ref } from 'vue'

const amount = ref(100)
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
</style>
