<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Login</h4>
        <form @submit.prevent="login">
          <div class="mb-3">
            <Alert :text="alertText" @dismissAlert="dismissAlert"/>
            <label for="username" class="form-label">Name</label>
            <input v-model="username" type="text" class="form-control" id="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="password" type="password" class="form-control" id="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import fetchUrl from "@/components/Fetch";
import Alert from "@/components/Alert";
export default {
  name: 'LoginView',
  components: {
    fetchUrl,
    Alert
  },
  data() {
    return {
      username: '',
      password: '',
      alertText:null,
    };
  },
  methods: {
    async login() {
      this.dismissAlert();
      let response = await fetchUrl.post("http://localhost:8001/api/login", {name: this.username, password: this.password});
      if(response.warning){
        this.setAlert();
      }else {
        this.$router.push({ name: 'home' });
      }
      },
    dismissAlert() {
      this.alertText = null;
    },
    setAlert() {
      this.alertText = "Unsuccessfull Login!";
    }
  },
};
</script>

<style>

</style>