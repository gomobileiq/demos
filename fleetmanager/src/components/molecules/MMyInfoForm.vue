<template>
  <div class="my-info-form">
    <ATitle h1>
      Change contact information
    </ATitle>
    <AFormRow field-sm="5">
      <div slot="title">
        First Name
      </div>
      <AInput
        slot="field"
        v-model="formData.firstName"
        v-validate="'required'"
        :error-messages="errors.collect('firstName')"
        name="firstName"
      />
    </AFormRow>
    <AFormRow field-sm="5">
      <div slot="title">
        Last Name
      </div>
      <AInput
        slot="field"
        v-model="formData.lastName"
        v-validate="'required'"
        :error-messages="errors.collect('lastName')"
        name="lastName"
      />
    </AFormRow>
    <AFormRow field-sm="5">
      <div slot="title">
        Email
      </div>
      <AInput
        slot="field"
        v-model="formData.email"
        v-validate="'required'"
        :error-messages="errors.collect('email')"
        name="email"
      />
    </AFormRow>
    <AFormRow field-sm="5">
      <div slot="title">
        Username
      </div>
      <AInput
        slot="field"
        v-model="formData.userName"
        v-validate="'required'"
        :error-messages="errors.collect('userName')"
        name="userName"/>
    </AFormRow>
    <hr>
    <AFormRow
      class="mt-4"
      field-sm="5"
    >
      <div slot="title">
        New Password
      </div>
      <AInput
        slot="field"
        v-model="formData.newPassword"
        v-validate="'required'"
        :error-messages="errors.collect('newPassword')"
        name="newPassword"
      />
    </AFormRow>
    <AFormRow field-sm="5">
      <div slot="title">
        New Password again
      </div>
      <AInput
        slot="field"
        v-model="formData.newPasswordAgain"
        name="newPasswordAgain"
      />
    </AFormRow>
    <AFlex end-xs>
      <ABtn @click="sendData">Save</ABtn>
      <ABtn
        transparent
        color="dark"
        class="ml-2"
      >Cancel</ABtn>
    </AFlex>
  </div>
</template>

<script>
// Components
import ATitle from '@atoms/ATitle';
import AInput from '@atoms/AInput';
import AFormRow from '@atoms/AFormRow';
import AFlex from '@atoms/AFlex';
import ABtn from '@atoms/ABtn';

// Mixins
import formMixin from '../../mixins/formMixin';

export default {
  name: 'MMyInfoForm',

  mixins: [
    formMixin,
  ],

  components: {
    ATitle,
    AInput,
    AFormRow,
    AFlex,
    ABtn,
  },

  data: () => ({
    formData: {
      firstName: '',
      lastName: '',
      email: '',
      userName: '',
      newPassword: '',
      newPasswordAgain: '',
    },
  }),

  methods: {
    async sendData() {
      const isValid = await this.validateForm();

      if (!isValid) return;
      // Foe example sendData
      this.$emit('send-data', this.formData);
    },
  },
};
</script>
