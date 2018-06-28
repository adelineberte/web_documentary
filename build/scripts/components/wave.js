import * as dynamics from '../libs/dynamics'

export default function setSideBarWave($container = document.querySelector('.barba-container'))
{
    const $sideBarWave = $container.querySelector('.chapter-about-container')

    if ($sideBarWave)
    {
        (function() {
            let $path = document.querySelector('.sideBarWave path')
            let $from = $path.getAttribute('d')
            let $to = $path.dataset['to']

            let $options = {
                type: dynamics.easeOut,
                durations: 1858,
                friction: 315
        }

            console.log("$From : " +$from)
            console.log("$To : " +$to)
            console.log("Dynamics : " +dynamics)
            console.log($path)

            let close = document.querySelector('.about-close-button')
            let open = document.querySelector('.chapter-medias-button')

            open.addEventListener('click', function (e) {
                e.stopPropagation()
                e.preventDefault()

                dynamics.animate($path, {
                    d: $to
                }, $options)
            })

            close.addEventListener('click', function (e) {
                e.stopPropagation()
                e.preventDefault()

                dynamics.animate($path, {
                    d: $from
                }, $options)
            })
        })()
    }
}