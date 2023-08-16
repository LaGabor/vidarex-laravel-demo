<template>
  <div class="container mt-5 d-flex justify-content-center">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title d-flex justify-content-center">Login</h3>
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
          <div class="mt-5 mb-3 d-flex justify-content-center" >
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
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
      let response = await fetchUrl.post("login", {name: this.username, password: this.password});
      if(response.warning){
        this.setAlert();
      }else {
        localStorage.setItem('token',response.token);
        localStorage.setItem('role',response.role);
        localStorage.setItem('name',response.name);
        this.$router.push('/').then(() => {
          window.location.reload();
        });
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
.card{
  width: 50%;
}
</style>