import { computed, isRef, Ref } from 'vue';

export default function useMonthlyPayment(
    total: Ref<number> | number,
    interstRate: Ref<number> | number,
    duration: Ref<number> | number,
) {
    const monthlyPayment = computed(() => {
        const monthlyInterest = isRef(interstRate)
            ? interstRate.value / 100 / 12
            : interstRate / 100 / 12;
        const numberOfPaymentMonths = isRef(duration)
            ? duration.value * 12
            : duration * 12;
        const principle = isRef(total) ? total.value : total;
        return (
            (principle *
                monthlyInterest *
                Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) /
            (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
        );
    });
    const durationInYears = isRef(duration) ? duration.value : duration;
    const totalPayment = computed(
        () => durationInYears * 12 * monthlyPayment.value,
    );
    const principle = isRef(total) ? total.value : total;
    const totalInterest = computed(() => totalPayment.value - principle);
    return { monthlyPayment, totalPayment, totalInterest };
}
