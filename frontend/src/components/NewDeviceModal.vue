<template>
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Create Device</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancel"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="create">
            <div class="form-group">
              <Alert :text="alertText" @dismissAlert="dismissAlert"/>
              <label for="ip"> IP</label>
              <input type="text" class="form-control" id="ip" v-model="ip" required>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" v-model="name" required>
            </div>
            <div class="modal-footer">
              <button type="button" id='cancelButton' class="btn btn-danger" data-bs-dismiss="modal" @click="cancel">Close</button>
              <button type="submit" class="btn btn-success" @click="create">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import fetchUrl from "@/components/Fetch";
import Alert from "@/components/Alert";

export default {
  name: "NewDeviceModal",
  components: {
    fetchUrl,
    Alert
  },
  data() {
    return {
      name: "",
      ip: "",
      id:"",
      alertText:null,
    };

  },
  methods: {
    create() {
      this.dismissAlert();
      const ipv4Regex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
      if (( this.name.trim() !== "" && ipv4Regex.test(this.ip))) {
        this.createDevice()
        this.$router.push('/').then(() => {
          window.location.reload();
        });
      }else{
        this.setAlert();
      }
    },
    cancel() {
      this.name = '';
      this.ip = '';
    },
    dismissAlert() {
      this.alertText = null;
    },
    setAlert() {
      this.alertText = "Invalid Inputs!";
    },
    async createDevice(){
      await fetchUrl.post("device/new", {deviceIp:this.ip, deviceName: this.name});

    }

  },
}
</script>

<style scoped>

</style>