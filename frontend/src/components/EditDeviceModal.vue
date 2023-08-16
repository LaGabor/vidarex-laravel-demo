<template>
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Edit Device</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="cancel"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <Alert :text="alertText" @dismissAlert="dismissAlert"/>
              <label for="ip">IP</label>
              <input type="text" :placeholder="device.ip" class="form-control" id="ip" v-model="ip" required>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" :placeholder="device.name" class="form-control" id="name" v-model="name" required>
            </div>
            <div class="modal-footer">
              <button type="button" id='cancelButton' class="btn btn-danger" data-bs-dismiss="modal" @click="cancel">Close</button>
              <button  class="btn btn-success" @click="edit">Edit</button>
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
    name: "EditDeviceModal",
    components: {
      fetchUrl,
      Alert
    },
    props: ["device"],
    data() {
      return {
        name: "",
        ip: "",
        alertText:null,
      };

    },
    methods: {
      edit() {
        this.dismissAlert();
        const ipv4Regex = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        if (( this.name.trim() !== "" && ipv4Regex.test(this.ip))) {
          this.editDevice()
          this.closeModal();
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
      closeModal() {
        const cancelButton = document.getElementById('cancelButton');
        const event = new MouseEvent('click');
        cancelButton.dispatchEvent(event);
      },
      async editDevice(){
       await fetchUrl.put("device/edit", {deviceIp:this.ip, deviceName: this.name, deviceId:this.device.id});
        this.$router.push('/').then(() => {
          window.location.reload();
        });
      }

    },
  }
</script>

<style scoped>

</style>