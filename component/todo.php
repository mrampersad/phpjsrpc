<?php require_once 'nav.php' ?>
<?php require_once 'todoitem.php' ?>
<script>
    class Todo extends React.Component {
        constructor(props) {
            super(props)

            this.state = {
                items: [],
            }
        }

        loadTodos = async () => {
            const response = await <?php p(function () {
                $db = new TodoDb();
                return $db->loadTodos();
            }); ?>();

            this.setState({ items: response })
        }

        addTodo = async e => {
            e.preventDefault()
            const name = e.target['name']
            const response = await <?php p(function ($name) {
                $db = new TodoDb();
                $db->addTodo($name);
            }); ?>(name.value)

            await this.loadTodos()
            name.value = ''
        }

        deleteTodo = async id => {
            const response = await <?php p(function ($id) {
                $db = new TodoDb();
                $db->deleteTodo($id);
            }); ?>(id)

            await this.loadTodos()
        }

        toggleTodo = async id => {
            const response = await <?php p(function ($id) {
                $db = new TodoDb();
                $db->toggleTodo($id);
            }); ?>(id)

            await this.loadTodos()
        }

        componentDidMount() {
            this.loadTodos();
        }

        render() {
            return (
                h('div', null,
                    h(Nav, null),
                    h('ul', null,
                        this.state.items.map(i => h(TodoItem, { key: i.id, onToggle: this.toggleTodo, onDelete: this.deleteTodo, ...i }))
                    ),
                    h('form', { className: 'row', onSubmit: this.addTodo },
                        h('div', { className: 'col-auto' },
                            h('label', { className: 'form-label' }, 'Add todo item'),
                        ),
                        h('div', { className: 'col-auto' },
                            h('input', { type: 'text', name: 'name', className: 'form-control mb-2 mr-sm-2' }, null),
                        ),
                        h('div', { className: 'col-auto' },
                            h('button', { type: 'submit', className: 'btn btn-primary' }, 'Add'),
                        ),
                    ),
                )
            )
        }
    }
</script>
