
<template>
  <div>
    <h1>Input Data</h1>
    <form @submit.prevent="saveData">
      <label for="phoneNumber">Phone Number:</label>
      <input type="number" id="phoneNumber" v-model="phoneNumber" required>

      <label for="operator">Operator:</label>
      <select id="operator" v-model="selectedOperator" required>
        <option value="telkomsel">Telkomsel</option>
        <option value="indosat">Indosat</option>
        <option value="xl">XL</option>
        <!-- Add other operators as needed -->
      </select>

      <button type="submit">Save</button>
      <button @click="autoFill">Auto</button>
    </form>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      phoneNumber: '',
      selectedOperator: 'telkomsel', // Set a default operator if needed
    };
  },
  methods: {
    saveData() {
      // Kirim data ke API Laravel
      axios.post('http://127.0.0.1:8000/api/phone-number', {
        phoneNumber: this.phoneNumber,
        operator:this.selectedOperator})
        .then(response => {
          // Handle respons dari API jika diperlukan
          console.log(response.data.message);
        })
        .catch(error => {
          // Handle error jika diperlukan
          console.error(error);
        });

      // ... Logika penyimpanan data lainnya
    },
    autoFill() {
      // Logic to auto-fill data
      // For example, you can set predefined values
      this.phoneNumber = 123456789;
      this.selectedOperator = 'telkomsel';
    },
  },
};
</script>

<style scoped>
/* Add any additional styles if needed */
</style>