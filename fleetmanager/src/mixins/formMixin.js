export default {
  methods: {
    async validateForm() {
      const isValidForm = await this.$validator.validateAll();

      if (!isValidForm) this.$nextTick(this.scrollToFirstError);

      return isValidForm;
    },

    addErrors(response) {
      const { errors } = response;

      if (!errors) throw response;

      Object.entries(errors).forEach(([field, messages]) => {
        messages.forEach((msg) => {
          this.errors.add({ field, msg });
        });
      });

      this.$nextTick(this.scrollToFirstError);
    },

    removeErrors(fields = []) {
      if (fields.length !== 0) {
        fields.forEach((field) => {
          const errorIndex = this.errors.items.findIndex(
            (errorItem) => field === errorItem.field,
          );

          if (errorIndex !== -1) this.$delete(this.errors.items, errorIndex);
        });
        return;
      }

      this.errors.clear();
    },

    scrollToFirstError() {
      const errors = Array.from(document.querySelectorAll('.error--text'));
      const firstError = errors.find((error) => error.style.display !== 'none');

      if (!firstError) return;

      firstError.scrollIntoView();
    },

    redirect(response) {
      window.location.assign(response.url);
    },
  },
};
