<template>
  <div class="example">
    <div class="file">
      <label class="file-label">
        <input :class="isLoading ? 'is-loading' : '' " :disabled="! canUpload" @change="persistFile" class="file-input button" type="file" id="file" ref="file" >
        <span class="file-cta">
          <span class="file-icon">
            <i class="fas fa-upload"></i>
          </span>
          <span class="file-label">
            Choose a file…
          </span>
        </span>
        <b-loading :is-full-page="false" v-model="isLoading" :can-cancel="true"></b-loading>
      </label>
    </div>
    <quill-editor
      class="editor"
      ref="myTextEditor"
      :value="content"
      :options="editorOption"
      @change="onEditorChange"
      @blur="onEditorBlur($event)"
      @focus="onEditorFocus($event)"
      @ready="onEditorReady($event)"
    />



    <!-- for debuging puporses only -->

<!--     <div class="output code">
      <code class="hljs" v-html="contentCode"></code>
    </div>
    <div class="output ql-snow">
      <div class="ql-editor" v-html="content"></div>
    </div> -->

  </div>
</template>

<script>
  import dedent from 'dedent'
  // import hljs from 'highlight.js'
  import debounce from 'lodash/debounce'
  import Quill from 'quill'

let BlockEmbed = Quill.import('blots/block/embed');
let Delta = Quill.import('delta');

class ImageBlot extends BlockEmbed {
  static create(value) {
    let node = super.create();
    node.setAttribute('alt', value.alt);
    node.setAttribute('src', value.url);
    node.setAttribute('srcset', value.srcset);
    node.setAttribute('sizes', value.sizes);
    return node;
  }

  static value(node) {
    return {
      alt: node.getAttribute('alt'),
      url: node.getAttribute('src'),
      srcset: node.getAttribute('srcset'),
      srcset: node.getAttribute('sizes')
    };
  }
}
ImageBlot.blotName = 'image';
ImageBlot.tagName = 'img';

Quill.register(ImageBlot);


  import { quillEditor } from 'vue-quill-editor'

  // highlight.js style
  // import 'highlight.js/styles/tomorrow.css'



  export default {
    props: {
      value: {
        default: ''
      }
    },
    name: 'quill-example-snow',
    title: 'Theme: snow',
    components: {
      quillEditor
    },
    data() {
      return {
        isLoading: false,
        imgname: '',
        canUpload: false,
        editorOption: {
          modules: {
            toolbar: [
              ['image'],
              ['bold', 'italic', 'underline', 'strike'],
              ['link','blockquote', 'code-block'],
              [{ 'header': 1 }, { 'header': 2 }],
              [{ 'list': 'ordered' }, { 'list': 'bullet' }],
              [{ 'script': 'sub' }, { 'script': 'super' }],
              [{ 'indent': '-1' }, { 'indent': '+1' }],
              [{ 'direction': 'rtl' }],
              [{ 'size': ['small', false, 'large', 'huge'] }],
              [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
              [{ 'font': [] }],
              [{ 'color': [] }, { 'background': [] }],
              [{ 'align': [] }],
              ['clean'],
              // ['link', 'image', 'video'],
              // [{'image': []}],
            ],
            // syntax: {
            //   highlight: text => hljs.highlightAuto(text).value
            // }
          }

        },
        content: dedent`
          
        `,
      }
    },
    watch: {
      value: function() {
        this.content = this.value;
      }
    },
    methods: {
      persistFile() {
        this.isLoading = true;
        if(! this.$refs.file.files[0]) return;
        this.imgname = this.$refs.file.files[0].name;
        let file = this.$refs.file.files[0];

        let data = new FormData();

        data.append('file', file);

        axios.post(`/posts/postimages`, data)
            .then(data => {
                this.insertIntoEditor(data);
                flash('File Uploaded!');
                this.isLoading = false;
            });
      },

      insertIntoEditor(data) {
        let range = this.editor.getSelection();
        this.editor.insertEmbed(range.index, 'image', {
          alt: data.data.alt + ' thumbnail',
          url: data.data.src,
          srcset: data.data.srcset,
          sizes: data.data.sizes
        });
      },
      onEditorChange: debounce(function(value) {
        this.content = value.html;
        this.$emit('content', value.html);
      }, 466),
      onEditorBlur(editor) {
        console.log('editor blur!', editor)
        this.canUpload = false;
      },
      onEditorFocus(editor) {
        console.log('editor focus!', editor)
        this.canUpload = true;
      },
      onEditorReady(editor) {
        console.log('editor ready!', editor)
      },

      // startInterval: function () {
      //   setInterval(() => {
      //     this.editor.on('text-change', () => {
      //       console.log('text change');
      //     })
      //   }, 1*1000);
      // },

    },
    computed: {
      editor() {
        return this.$refs.myTextEditor.quill
      },

      // contentCode() {
      //   return hljs.highlightAuto(this.content).value
      // }
    },
    mounted() {
      console.log('this is Quill instance:', this.editor)
      if (this.value) {
        this.content = this.value
      }
    }
  };
</script>

<style lang="scss" scoped>
  .example {
    display: flex;
    flex-direction: column;

    .editor {
      height: 40rem;
      overflow: hidden;
    }

    .output {
      width: 100%;
      height: 20rem;
      margin: 0;
      border: 1px solid #ccc;
      overflow-y: auto;
      resize: vertical;

      &.code {
        padding: 1rem;
        height: 16rem;
      }

      &.ql-snow {
        border-top: none;
        height: 24rem;
      }
    }
  }
</style>