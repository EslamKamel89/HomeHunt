export default function pr<T>(value: T, title: string = ''): T {
    console.log('_/\\_'.repeat(3) + title + '_/\\_'.repeat(3));
    console.log(value);
    return value;
}
