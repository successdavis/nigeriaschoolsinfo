<template>
    <div>
        <div class="file">
            <div class="file is-small">
              <label class="file-label">
                <input class="file-input" id="avater" type="file" name="resume" accept="image/*" @change="onChange">
                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fas fa-upload"></i>
                  </span>
                  <span class="file-label">
                    Choose a file…
                  </span>
                </span>
              </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            onChange(e) {
                if(! e.target.files.length) return;
                let file = e.target.files[0];

                let reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = e => {
                    let src = e.target.result;

                    this.$emit('loaded', {src, file});
                };

                // Persis to the server
                // this.persist(avatar);
            }
        }
    }
</script>
