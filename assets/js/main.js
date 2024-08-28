export const Main = () => {

    /*
     * Setup carousel
     */

    // Grab wrapper nodes
    const rootNode = document.querySelector('.embla')
    if (!rootNode) return

    const viewportNode = rootNode.querySelector('.embla__viewport')

    // Grab button nodes
    const prevButtonNode = rootNode.querySelector('.embla__prev')
    const nextButtonNode = rootNode.querySelector('.embla__next')

    // Initialize the carousel
    const embla = EmblaCarousel(viewportNode, { loop: true })

    // Add click listeners
    prevButtonNode.addEventListener('click', embla.scrollPrev, false)
    nextButtonNode.addEventListener('click', embla.scrollNext, false)
}

document.addEventListener('DOMContentLoaded', () => {
    Main()
})