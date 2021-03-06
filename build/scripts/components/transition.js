import setMenu from './menu'
import setMedias from './medias'
import setSlider from './slider'
import setPopup from './popup'
import setSideBarWave from './wave'
import setBar from './bar'
import setAudio from './audio'
import setVideo from './video'

setMenu()
setMedias()
setSlider()
setPopup()
setSideBarWave()
setBar()
setAudio()
setVideo()

const $links = document.querySelectorAll('a')

for (const $link of $links)
{
    if ($link.href == window.location.href)
    {
        $link.addEventListener('click', event =>
        {
            event.preventDefault()
        })
    }
}
document.addEventListener('DOMContentLoaded', () =>
{
    Barba.Pjax.init()
    Barba.Prefetch.init()
    
    let changePage = Barba.BaseTransition.extend(
        {
            start: function ()
            {
                Promise
                    .all([this.newContainerLoading, () => {}])
                    .then(this.change.bind(this))
            },

            change: function ()
            {
                setMenu(this.newContainer)
                setMedias(this.newContainer)
                setSlider(this.newContainer)
                setPopup(this.newContainer)
                setSideBarWave(this.newContainer)
                setBar(this.newContainer)
                setAudio(this.newContainer)
                setVideo(this.newContainer)
                const $links = this.newContainer.querySelectorAll('a')

                for (const $link of $links)
                {
                    if ($link.href == window.location.href)
                    {
                        $link.addEventListener('click', event =>
                        {
                            event.preventDefault()
                        })
                    }
                }
                this.done()
            }
        }
    )

    Barba.Pjax.getTransition = function ()
    {
        return changePage
    }
})