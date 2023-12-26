<template>
  <div>
    <h1>List Data</h1>
    <ul>
      <li v-for="dataItem in dataList" :key="dataItem.id">
        {{ dataItem.phoneNumber }} - {{ dataItem.operator }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      dataList: [],
    };
  },
  mounted() {
    window.Echo.channel('public').listen('DataSaved', (e) => {
    console.log('Data saved event received:', e);

    // Jika ada perubahan, perbarui data
    this.fetchData();
  });

  // Pertama kali, lakukan pemanggilan API untuk mendapatkan data
  this.fetchData();
    // Ambil semua data dari API Laravel saat komponen dimuat
  
  },
  methods: {
    fetchData() {
    axios.get('http://127.0.0.1:8000/api/phone-number')
      .then(response => {
        console.log('Data fetched successfully:', response.data);
        this.dataList = response.data.data;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
  },
  },
};
</script>

<style scoped>
/* Add any additional styles if needed */
</style>