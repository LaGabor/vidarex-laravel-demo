<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <Alert :text="alertText" @dismissAlert="dismissAlert"/>
        <h4 class="card-title">Register</h4>
        <form @submit.prevent="register">
          <div class="mb-3">
            <label for="username" class="form-label">Name</label>
            <input v-model="username" type="text" class="form-control" id="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Email</label>
            <input v-model="email" type="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="password" type="password" class="form-control" id="password" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password Check</label>
            <input v-model="passwordCheck" type="password" class="form-control" id="password" required>
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
  name: 'RegisterView',
  components: {
    fetchUrl,
    Alert,
  },
  data() {
    return {
      username: '',
      password: '',
      passwordCheck: '',
      email:'',
      alertText:null,
    };
  },
  methods: {
    async register() {
      if(this.passwordCheck !== this.password){
        this.setAlert("Passwords not matching!");
        return;
      }
      this.dismissAlert();
      let response = await fetchUrl.post("http://localhost:8001/api/register", {name: this.username, password: this.password, email: this.email});
      if(response.warning){
        this.setAlert("Unsuccessfull Registration!");
      }else{
        this.$router.push({ name: 'home' });
      }
    },
    dismissAlert() {
      this.alertText = null;
    },
    setAlert(text) {
      this.alertText = text;
    }
  },
};
</script>

<style>

</style>