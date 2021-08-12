<script>
    class Greet extends React.Component {
        greet = async e => {
            e.preventDefault()
            const name = e.target['name'].value;
            const response = await <?php p(function ($name) {
                return ['greeting' => "Hi $name, the server time is: " . date('Y-m-d H:i:s')];
            }); ?>(name);

            alert(response.greeting);
        }

        render() {
            return (
                h('form', { onSubmit: this.greet },
                    h('div', { className: 'mb-3' },
                        h('label', { className: 'form-label' }, 'Enter your name'),
                    ),
                    h('div', { className: 'mb-3' },
                        h('input', { type: 'text', name: 'name', className: 'form-control' }, null),
                    ),
                    h('button', { type: 'submit', className: 'btn btn-primary' }, 'Greet'),
                )
            )
        }
    }
</script>
