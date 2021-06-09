<template>
  <v-content id="contact" class="pt-10">
    <v-container>
        <h1 class="aqua">CONTACT US</h1>
    </v-container>
    <div class="block hidden-xs-only">
        <contactbig :name="name" :nameRules="nameRules" :email="email" :emailRules="emailRules" :message="message" :messageRules="messageRules"></contactbig>
    </div>
    <div class="hidden-sm-and-up">
        <contactsmall :name="name" :nameRules="nameRules" :email="email" :emailRules="emailRules" :message="message" :messageRules="messageRules"></contactsmall>
    </div>
    <div class="googlemap pt-10">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12718.565692904409!2d-3.5911843!3d37.1612249!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5cc395f96e47c0d9!2sIES%20Zaid%C3%ADn%20Vergeles!5e0!3m2!1sen!2ses!4v1618955216584!5m2!1sen!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></iframe>
    </div>
  </v-content>
</template>

<script>
import contactsmall from './contact/contact-small.vue';
import contactbig from './contact/contact-big.vue';
export default {
  components: { contactsmall, contactbig },
  data: () => ({
    valid: true,
    alert: false,
    name: "",
    nameRules: [
      v => !!v || "Name is required"
    ],
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+\..+/.test(v) || "E-mail must be valid"
    ],
    message: "",
    messageRules: [
      v => !!v || "Message is required",
      v => (v && v.length >= 10) || "Message must be more than 10 characters"
    ],
  }),
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        return true;
      } else return false;
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.alert = true;
        const params = { name: this.name, email: this.email, message: this.message };
        axios.post('/storeMessage/', params).then(
          this.$refs.form.reset()
        );
      }
    },
    reset() {
      this.$refs.form.reset();
    }
  }
};
</script>