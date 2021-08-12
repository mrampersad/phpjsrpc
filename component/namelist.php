<script>
    class NameList extends React.Component {
        constructor(props) {
            super(props)

            this.state = {
                items: [],
            }
        }

        componentDidMount() {
            this.getRandomNameList();
            this.timer = setInterval(this.getRandomNameList, 5000)
        }

        componentWillUnmount() {
            clearInterval(this.timer);
        }

        getRandomNameList = async () => {
            const state = await <?php p(function () {
                //$names = json_decode(file_get_contents('https://raw.githubusercontent.com/dominictarr/random-name/master/first-names.json'));

                // start with a list of names
                $names = explode(',', 'liam,olivia,noah,emma,oliver,ava,elijah,charlotte,william,sophia,james,amelia,benjamin,isabella,lucas,mia,henry,evelyn,alexander,harper');

                // shuffle them
                shuffle($names);

                // select a random subset
                $max = mt_rand(0, count($names));

                // accumulate them
                $items = [];
                for($i = 0; $i < $max; $i++) {
                    $items[] = $names[$i];
                }

                // return the list
                return ['items' => $items];
            }); ?>();

            this.setState(state)
        }

        render() {
            return h('div', null,
                h('div', null, 'Periodically updated list of random names'),
                h('ol', null, this.state.items.map(i => h('li', { key: i }, i)))
            )
        }
    }
</script>
