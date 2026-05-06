import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.data('countdown', (targetIso) => ({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
    started: false,
    timer: null,
    init() {
        this.update(targetIso)
        this.timer = setInterval(() => this.update(targetIso), 1000)
    },
    destroy() {
        if (this.timer) {
            clearInterval(this.timer)
        }
    },
    update(targetIso) {
        const diff = new Date(targetIso).getTime() - Date.now()

        if (diff <= 0) {
            this.started = true
            this.days = this.hours = this.minutes = this.seconds = 0
            this.destroy()
            return
        }

        this.days = Math.floor(diff / 86400000)
        this.hours = Math.floor((diff % 86400000) / 3600000)
        this.minutes = Math.floor((diff % 3600000) / 60000)
        this.seconds = Math.floor((diff % 60000) / 1000)
    },
}))

Alpine.start()
