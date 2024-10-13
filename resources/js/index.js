import { EditorView, highlightActiveLine, highlightSpecialChars, keymap } from "@codemirror/view"
import { defaultKeymap, history, historyKeymap } from "@codemirror/commands"
import { Compartment, EditorState } from "@codemirror/state"
import { MySQL, sql } from "@codemirror/lang-sql"
import { autocompletion, closeBrackets, closeBracketsKeymap, completionKeymap, startCompletion } from "@codemirror/autocomplete"
import { bracketMatching, defaultHighlightStyle, indentOnInput, syntaxHighlighting } from "@codemirror/language"
import { githubLight, githubDark } from '@uiw/codemirror-theme-github';

export default ({
    state,
    schema,
}) => ({
    /** @type EditorView */
    editor: null,
    state,
    schema,

    init() {
        const theme = new Compartment()

        const onUpdate = EditorView.updateListener.of((update) => {
            if (!update.docChanged) return;

            this.state = update.state.doc.toString();
        });

        this.editor = new EditorView({
            parent: this.$refs.editor,
            state: EditorState.create({
                doc: state.initialValue,
                extensions: [
                    EditorState.allowMultipleSelections.of(true),
                    sql({
                        upperCaseKeywords: true,
                        dialect: MySQL,
                        schema
                    }),
                    onUpdate,
                    history(),
                    indentOnInput(),
                    closeBrackets(),
                    autocompletion(),
                    bracketMatching(),
                    highlightActiveLine(),
                    highlightSpecialChars(),
                    theme.of(this.$store.theme === 'dark' ? githubDark : githubLight),
                    syntaxHighlighting(defaultHighlightStyle, { fallback: true }),
                    keymap.of([
                        ...defaultKeymap,
                        ...historyKeymap,
                        ...completionKeymap,
                        { key: "Shift-Space", run: startCompletion },
                        ...closeBracketsKeymap,
                    ])
                ],
            }),
        })

        window.addEventListener('theme-changed', ({ detail: mode }) => {
            this.editor.dispatch({
                effects: theme.reconfigure(mode === 'dark' ? githubDark : githubLight)
            })
        })
    },
})