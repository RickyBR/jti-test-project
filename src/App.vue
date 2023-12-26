<template>
  <div id="app">
    <div class="navigation">
      <button @click="navigateTo('/input-data')">Go to Input Page</button>
      <button @click="navigateTo('/list')">Go to List Page</button>
      <button @click="redirectToGoogle">Login with Google</button>

    </div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  mounted() {
    this.setupEcho();
  },
  beforeUnmount() {
    this.tearDownEcho();
  },
  methods: {
    navigateTo(path) {
      this.$router.push(path);
    },
    setupEcho() {
      this.echoChannel = window.Echo.channel('public');
      this.echoChannel.listen('Hello', this.handleHelloEvent);
    },
    tearDownEcho() {
      this.echoChannel.stopListening('Hello', this.handleHelloEvent);
    },
    handleHelloEvent(e) {
      console.log('go public');
      // code for displaying the server data
      console.log(e); // the data from the server
    },
    redirectToGoogle() {
    window.location.href = 'http://127.0.0.1:8000/login/google';
  },
  }
}
</script>

<style>
#app {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.navigation {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

/* Optional: Style the router links */
router-link {
  margin-right: 10px;
}
</style>