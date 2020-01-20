<template>
  <div class="login-body">
    <AFlex
      class="pt-3 auth-page-body"
      between-xs
    >
      <ACol
        class="px-4 py-3 auth-page-body__form"
        xs="8"
      >
        <ATitle h2 class="mt-0">
          Login to your Headlight Account
        </ATitle>
        <div class="auth-page-body__forgot">
          <a href="#">I forgot my username and/or password</a>
        </div>
        <ACol
          class="mt-4 auth-page-body__form-row"
          xs="8"
        >
          <ACol xs="3">
            Username
          </ACol>
          <ACol xs="9">
            <AInput
              v-model="formData.name"
              v-validate="'required|alpha_dash'"
              :error-messages="errors.collect('name')"
              name="name"
            />
          </ACol>
        </ACol>
        <ACol
          class="mt-2 auth-page-body__form-row"
          xs="8"
        >
          <ACol xs="3">
            Password
          </ACol>
          <ACol xs="9">
            <AInput
              v-model.trim="formData.password"
              v-validate="'required'"
              type="password"
              :error-messages="errors.collect('password')"
              name="password"
            />
          </ACol>
        </ACol>
        <ACol
          class="mt-2 auth-page-body__form-row"
          xs="8"
        >
          <ACheckbox v-model.number="formData.remember" />
          <div>
            Remember me on this computer
          </div>
        </ACol>
        <ACol class="mt-3 auth-page-body__login-button">
          <ABtn
            color="blue"
            @click="login"
          >
            Login to my account
          </ABtn>
        </ACol>
      </ACol>
      <ACol
        class="pa-3 auth-page-body__quick-start"
        xs="3"
        middle-xs

      >
        <div class="auth-page-body__quick-start--title">
          HEADLIGHT 101:<br>
          QUICK START
        </div>
        <div class="auth-page-body__quick-start--program">
          Quick Start Program is a series
          of brief video lessons delivered
          straight to your Inbox. You'll learn
          Headlight inside and out in record time.
        </div>
        <div class="py-1 auth-page-body__quick-start--sign-up-me">
          <ABtn
            color="red"
            @click="signMeUp"
          >
            Sign me up!
          </ABtn>
        </div>
        <div class="auth-page-body__quick-start--planning">
          Signup now and become a route planning genius. And yes, it's free
        </div>
      </ACol>
    </AFlex>
  </div>
</template>

<script>
// Components
import AFlex from '@atoms/AFlex';
import ACol from '@atoms/ACol';
import ATitle from '@atoms/ATitle';
import AInput from '@atoms/AInput';
import ACheckbox from '@atoms/ACheckbox';
import ABtn from '@atoms/ABtn';

// Mixins
import formMixin from '../../mixins/formMixin';

export default {
  name: 'MLoginBody',

  mixins: [formMixin],

  components: {
    AFlex,
    ACol,
    ATitle,
    AInput,
    ACheckbox,
    ABtn,
  },

  data: () => ({
    formData: {
      remember: 0,
      name: '',
    },
  }),

  methods: {
    async login() {
      const isValid = await this.validateForm();

      if (!isValid) return;

      localStorage.setItem('name', this.formData.name);
      this.$router.push('/');
    },

    signMeUp() {
      window.location.assign('http://www.gomobileiq.com/quickstart-optin/');
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@design";

.auth-page-body {
  &__form {
    background: #fff;
    width: 65%;
    height: auto;
    padding: 15px 30px;
    border-radius: 5px;
  }

  &__form-row {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
  }

  &__login-button {
    display: flex;
    justify-content: center;
  }

  &__quick-start {
    background: $pale-blue;
    background: #e4ecf2;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    text-align: center;

    &--title {
      font-size: 24px;
      color: $red-error;
      font-weight: 700;
    }

    &--program {
      font-size: 20px;
      color: #000;
      font-weight: 500;
    }

    &--planning {
      font-weight: 700;
    }
  }
}
</style>
