<template>
  <div class="row justify-content-center">
    <div class="col-10">
      <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
  </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-editor-classic/src/classiceditor";

import EssentialsPlugin from "@ckeditor/ckeditor5-essentials/src/essentials";
import BoldPlugin from "@ckeditor/ckeditor5-basic-styles/src/bold";
import ItalicPlugin from "@ckeditor/ckeditor5-basic-styles/src/italic";
import LinkPlugin from "@ckeditor/ckeditor5-link/src/link";
import ParagraphPlugin from "@ckeditor/ckeditor5-paragraph/src/paragraph";
import Mention from "@ckeditor/ckeditor5-mention/src/mention";
const items = [
  {
    id: "@swarley",
    userId: "1",
    name: "Barney Stinson",
    link: "https://www.imdb.com/title/tt0460649/characters/nm0000439"
  },
  {
    id: "@lilypad",
    userId: "2",
    name: "Lily Aldrin",
    link: "https://www.imdb.com/title/tt0460649/characters/nm0004989"
  },
  {
    id: "@marshmallow",
    userId: "3",
    name: "Marshall Eriksen",
    link: "https://www.imdb.com/title/tt0460649/characters/nm0781981"
  },
  {
    id: "@rsparkles",
    userId: "4",
    name: "Robin Scherbatsky",
    link: "https://www.imdb.com/title/tt0460649/characters/nm1130627"
  },
  {
    id: "@tdog",
    userId: "5",
    name: "Ted Mosby",
    link: "https://www.imdb.com/title/tt0460649/characters/nm1102140"
  }
];
function getFeedItems(queryText) {
  // As an example of an asynchronous action, return a promise
  // that resolves after a 100ms timeout.
  // This can be a server request or any sort of delayed action.
  return new Promise(resolve => {
    setTimeout(() => {
      const itemsToDisplay = items
        // Filter out the full list of all items to only those matching the query text.
        .filter(isItemMatching)
        // Return 10 items max - needed for generic queries when the list may contain hundreds of elements.
        .slice(0, 10);

      resolve(itemsToDisplay);
    }, 100);
  });

  // Filtering function - it uses the `name` and `username` properties of an item to find a match.
  function isItemMatching(item) {
    // Make the search case-insensitive.
    const searchString = queryText.toLowerCase();

    // Include an item in the search results if the name or username includes the current user input.
    return (
      item.name.toLowerCase().includes(searchString) ||
      item.id.toLowerCase().includes(searchString)
    );
  }
}

function customItemRenderer(item) {
  const itemElement = document.createElement("span");

  itemElement.classList.add("custom-item");
  itemElement.id = `mention-list-item-id-${item.id}`;
  itemElement.textContent = `${item.name} `;

  const usernameElement = document.createElement("span");

  usernameElement.classList.add("custom-item-username");
  usernameElement.textContent = item.id;

  itemElement.appendChild(usernameElement);

  return itemElement;
}

export default {
  name: "app",
  methods: {
    async getfeeds(k) {
      let key = k.toLowerCase();
      console.log(key);
      //   const { data } = await axios.get("searchpatient", { params: { key } });
      const user = this.$store.state.user.data;
      return Object.keys(user)
        .map(d => {
          return {
            id: `:${user[d]}`,
            name: `${d}`
          };
        })
        .filter(u => u.name.toLowerCase().match(key));
    }
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        plugins: [
          EssentialsPlugin,
          BoldPlugin,
          ItalicPlugin,
          Mention,
          LinkPlugin,
          ParagraphPlugin
        ],
        mention: {
          feeds: [
            {
              marker: ":",
              feed: this.getfeeds,
              itemRenderer: customItemRenderer
            }
          ]
        },
        toolbar: {
          items: [
            "bold",
            "italic",
            "link",
            "undo",
            "redo"
            // 'mention'
          ]
        }
      }
    };
  },
  mounted() {
    // this.editor.execute( 'mention', { marker: '@', mention: 'John' } );
  }
};
</script>