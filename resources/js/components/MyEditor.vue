<template>
  <div>
    <div class="file">
      <label class="file-label">
        <input @change="persistFile" class="file-input" type="file" id="file" ref="file" >
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
    <!-- Two-way Data-Binding -->
    <quill-editor
      ref="editor"
      v-model="content"
      :options="editorOption"
      @blur="onEditorBlur($event)"
      @focus="onEditorFocus($event)"
      @ready="onEditorReady($event)"
    />

<!-- 
    <div class="output code">
      <code class="hljs" v-html="contentCode"></code>
    </div>
    <div class="output ql-snow">
      <div class="ql-editor" v-html="content"></div>
    </div>
-->
  </div>
</template>

<script>
  
  import Quill from 'quill'

  import hljs from 'highlight.js'

 
let BlockEmbed = Quill.import('blots/block/embed');

class ImageBlot extends BlockEmbed {
  static create(value) {
    let node = super.create();
    node.setAttribute('alt', value.alt);
    node.setAttribute('src', value.url);
    return node;
  }

  static value(node) {
    return {
      alt: node.getAttribute('alt'),
      url: node.getAttribute('src')
    };
  }
}
ImageBlot.blotName = 'image';
ImageBlot.tagName = 'img';

import { quillEditor } from 'vue-quill-editor'
  export default {
    components: {
      quillEditor
    },
    data () {
      return {
        content: '',
        editorOption: {
          // Some Quill options...
        }
      }
    },
    methods: {

      persistFile() {
        // if(! this.$refs.file.length) return;
        let file = this.$refs.file.files[0];

        let data = new FormData();

        data.append('file', file);

        axios.post(`/posts/postimages`, data)
            .then(data => {
                this.insertIntoEditor(data);
                flash('File Uploaded!');
            });
      },

      insertIntoEditor(data) {
        console.log(data.data.alt);
        let range = this.editor.getSelection();
        this.editor.insertEmbed(range.index, 'image', {
          alt: 'some-text-here',
          alt: data.data.src,
        });
      },



      onEditorBlur(quill) {
        console.log('editor blur!', quill)
      },
      onEditorFocus(quill) {
        console.log('editor focus!', quill)
      },
      onEditorReady(quill) {
        console.log('editor ready!', quill)
      },
      onEditorChange({ quill, html, text }) {
        console.log('editor change!', quill, html, text)
        this.content = html
      }
    },
    computed: {
      editor() {
        return this.$refs.editor.quill
      },

      contentCode() {
        return hljs.highlightAuto(this.content).value
      }
    },
    mounted() {
      console.log('this is current quill instance object', this.editor)
    }
  };
</script>